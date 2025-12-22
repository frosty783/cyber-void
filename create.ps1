# -------------------------------
# Create the directory structure
# -------------------------------
New-Item -ItemType Directory -Force -Path `
    app\classes\class-1, `
    app\challenges\easy, `
    app\challenges\medium, `
    app\challenges\hard


# -------------------------------
# Create class 1 content
# -------------------------------
@'
{
    "title": "Introduction to Cybersecurity",
    "description": "Learn the basics of cybersecurity, common threats, and security principles.",
    "estimated_time": "2 hours",
    "prerequisites": "None"
}
'@ | Set-Content app\classes\class-1\info.json


@'
# Introduction to Cybersecurity

## What is Cybersecurity?

Cybersecurity is the practice of protecting systems, networks, and programs from digital attacks.

## Key Concepts

### CIA Triad
- **Confidentiality**: Ensuring information is not disclosed to unauthorized individuals
- **Integrity**: Maintaining consistency and trustworthiness of data
- **Availability**: Ensuring information is available when needed

## Practice Exercise

Try to identify security vulnerabilities in a simple web application.
'@ | Set-Content app\classes\class-1\content.md


# -------------------------------
# Create challenge 1 content
# -------------------------------
@'
{
    "title": "Hello World Intrusion",
    "description": "A basic challenge to get started with cybersecurity.",
    "points": 100,
    "category": "Web Security",
    "flag": "BSY{hello_world_2024}",
    "hints": [
        "Check the page source",
        "Look for comments in the HTML"
    ],
    "files": [],
    "content": "# Hello World Intrusion\n\nWelcome to your first cybersecurity challenge!\n\nFind the hidden flag.\n\nFlag format: BSY{text_here}"
}
'@ | Set-Content app\challenges\easy\challenge-1.json


# -------------------------------
# Create more sample classes
# -------------------------------
2..10 | ForEach-Object {
    $i = $_
    New-Item -ItemType Directory -Force -Path "app\classes\class-$i"

@"
{
    "title": "Class $($i): Sample Class",
    "description": "This is class $i description.",
    "estimated_time": "1.5 hours",
    "prerequisites": "Class $($i - 1)"
}
"@ | Set-Content "app\classes\class-$i\info.json"
}


# -------------------------------
# Create more sample challenges
# -------------------------------
@'
{
    "title": "Cybernet Shockwave Report",
    "description": "Analyze network traffic patterns.",
    "points": 150,
    "category": "Network Security",
    "flag": "BSY{network_analysis}",
    "hints": [
        "Look for unusual traffic patterns",
        "Check timestamps"
    ],
    "files": [],
    "content": "Analyze the network traffic and find the anomaly."
}
'@ | Set-Content app\challenges\easy\challenge-2.json


@'
{
    "title": "Famous Quotes Decoder",
    "description": "Decode hidden messages in famous quotes.",
    "points": 200,
    "category": "Cryptography",
    "flag": "BSY{crypto_is_fun}",
    "hints": [
        "Try different encoding methods",
        "Look for patterns"
    ],
    "files": [],
    "content": "Decode the hidden message in the quote."
}
'@ | Set-Content app\challenges\medium\challenge-3.json
