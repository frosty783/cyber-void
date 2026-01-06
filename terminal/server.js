const WebSocket = require("ws");
const pty = require("node-pty");
const crypto = require("crypto");

const wss = new WebSocket.Server({ port: 3001 });

// sessionId -> pty
const sessions = new Map();

function createShell() {
  return pty.spawn("bash", [], {
    name: "xterm-color",
    cols: 80,
    rows: 24,
    cwd: "/root",
    env: process.env
  });
}

wss.on("connection", (ws, req) => {
  // Expect sessionId from query string
  const url = new URL(req.url, "http://localhost");
  let sessionId = url.searchParams.get("sessionId");

  if (!sessionId) {
    sessionId = crypto.randomUUID();
    ws.send(JSON.stringify({ type: "session", sessionId }));
  }

  let shell = sessions.get(sessionId);

  if (!shell) {
    shell = createShell();
    sessions.set(sessionId, shell);

    shell.on("exit", () => {
      sessions.delete(sessionId);
    });
  }

  shell.on("data", data => {
    if (ws.readyState === WebSocket.OPEN) {
      ws.send(data);
    }
  });

  ws.on("message", msg => shell.write(msg));

  ws.on("close", () => {
    // IMPORTANT: do NOT kill shell
    // shell persists until container dies or shell exits
  });
});
