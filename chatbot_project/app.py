from flask import Flask, request, jsonify, render_template
import requests
import re
import os
from dotenv import load_dotenv

# Load environment variables
load_dotenv()

app = Flask(__name__)

# Get API key from environment variable
OPENROUTER_API_KEY = os.getenv("OPENROUTER_API_KEY")
API_URL = "https://openrouter.ai/api/v1/chat/completions"

HEADERS = {
    "Authorization": f"Bearer {OPENROUTER_API_KEY}",
    "Content-Type": "application/json"
}

def format_response(text):
    """Format the raw response to improve readability"""
    
    text = re.sub(r'\n{3,}', '\n\n', text)
    text = text.replace('\n', '<br>')
    text = re.sub(r'- (.*?)(?=<br>|$)', r'• \1', text)
    text = re.sub(r'\*\*(.*?)\*\*', r'<strong>\1</strong>', text)
    text = re.sub(r'\*(.*?)\*', r'<em>\1</em>', text)
    text = re.sub(r'```(.*?)```', r'<pre><code>\1</code></pre>', text, flags=re.DOTALL)
    text = re.sub(r'`(.*?)`', r'<code>\1</code>', text)
    
    return text

def get_chatbot_response(user_input):
    """Send request to OpenRouter API and return the formatted response"""
    
    messages = [
        {"role": "system", "content": "Provide clear, concise responses with good formatting."},
        {"role": "user", "content": user_input}
    ]
    
    payload = {
        "model": "qwen/qwq-32b:free",
        "messages": messages
    }
    
    try:
        response = requests.post(API_URL, headers=HEADERS, json=payload)
        response.raise_for_status()
        
        raw_response = response.json()["choices"][0]["message"]["content"]
        formatted_response = format_response(raw_response)
        
        return formatted_response
        
    except requests.exceptions.RequestException as e:
        return f"Sorry, I encountered an error: {str(e)}"

@app.route("/")
def home():
    return render_template("index.html")

@app.route("/chat", methods=["POST"])
def chat():
    data = request.get_json()
    user_input = data.get("message", "")
    
    if not user_input:
        return jsonify({"error": "No message provided"}), 400
    
    response = get_chatbot_response(user_input)
    return jsonify({"response": response})

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)
