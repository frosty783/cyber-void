const term = new Terminal({
  cursorBlink: true,
  fontSize: 14
});

term.open(document.getElementById("terminal"));

let sessionId = localStorage.getItem("terminalSession");

const socket = new WebSocket(
  `ws://${location.host}/terminal-ws/?sessionId=${sessionId || ""}`
);


socket.onmessage = (e) => {
  try {
    const msg = JSON.parse(e.data);
    if (msg.type === "session") {
      localStorage.setItem("terminalSession", msg.sessionId);
      return;
    }
  } catch {
    term.write(e.data);
  }
};

term.onData(data => socket.send(data));
