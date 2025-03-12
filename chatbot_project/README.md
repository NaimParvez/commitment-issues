
# Chatbot Project

A simple, modern chatbot application powered by OpenRouter's Qwen QwQ 32B (free) model. This project features a web-based chat interface designed like a messaging app, with user and bot messages displayed in styled bubbles. It uses Flask as the backend to handle API requests and responses, communicating with OpenRouter’s API to leverage the QwQ 32B model for natural language understanding and generation.

## Overview
This chatbot is built to provide conversational responses using the Qwen QwQ 32B model, a 32-billion-parameter reasoning-focused large language model (LLM) from the Qwen series. QwQ 32B excels in tasks requiring reasoning, such as answering quiz questions, solving problems, and engaging in personalized conversations. The project runs entirely via API, eliminating the need for local model hosting and reducing resource demands.

The chat interface is styled to resemble a messaging app, with user messages in blue bubbles on the right and bot responses in gray bubbles on the left. Features like italicized text (e.g., *text*) and emojis (e.g., 😄) are rendered for a polished look.

## Features
- **Modern Chat Interface**: Bubble-style messages with user (blue, right) and bot (gray, left) responses.
- **QwQ 32B Model**: Leverages OpenRouter’s free tier for the Qwen QwQ 32B model (32B parameters, 131K context window).
- **Lightweight Setup**: No local model hosting—uses OpenRouter API, requiring only `flask` and `requests`.
- **Quiz Support**: Optimized for structured queries like multiple-choice questions, with formatted responses (e.g., bolded answers).
- **Jupyter Notebook**: Includes a prototype (`chatbot.ipynb`) for testing the API integration in a console environment.

## Project Structure
```
chatbot_project/
├── app.py                 # Flask backend with OpenRouter QwQ 32B API integration
├── requirements.txt       # Dependencies (flask, requests)
├── templates/
│   └── index.html         # Webpage with chat interface (bubble-style messages)
├── static/
│   └── style.css          # Styling for the chat UI (bubbles, layout)
├── notebook/
│   └── chatbot.ipynb      # Jupyter Notebook for testing the API
└── README.md              # Project documentation (this file)
```

## Setup Instructions
### Prerequisites
- Python 3.8 or higher
- An OpenRouter API key (free tier available)
- Internet connection (for API calls)

### Steps
1. **Clone or Set Up the Project**:
   - Create a project directory and place the files as shown in the structure above.
   - Alternatively, clone this repository if hosted on GitHub.

2. **Get an OpenRouter API Key**:
   - Sign up at [openrouter.ai](https://openrouter.ai).
   - Go to “Keys” in your dashboard and copy your API key.

3. **Set Up a Virtual Environment** (Optional but Recommended):
   ```bash
   python -m venv .venv
   # Windows
   .venv\Scripts\activate
   # Linux/Mac
   source .venv/bin/activate
   ```

4. **Install Dependencies**:
   ```bash
   pip install -r requirements.txt
   ```
   - Installs `flask==3.0.3` and `requests==2.31.0`.

5. **Update API Key**:
   - Open `app.py` and `notebook/chatbot.ipynb`.
   - Replace `"your-openrouter-api-key-here"` with your OpenRouter API key.

6. **Run the Web App**:
   ```bash
   python app.py
   ```
   - The app will run on `http://localhost:5000`.

7. **Access the Chatbot**:
   - Open `http://localhost:5000` in a browser.
   - Type a message (e.g., “Hello” or a quiz question) and see the response in a styled bubble.

8. **Test in Jupyter (Optional)**:
   - Open `notebook/chatbot.ipynb` in Jupyter Notebook.
   - Run the cells to test the API integration in a console environment.

## Example Usage
- **Input**: “Why don’t skeletons fight each other?”
- **Output** (in a gray bubble):
  ```
  Chatbot: Why don’t skeletons fight each other? …Because they don’t have the <em>guts</em>! 😄 Got any requests for another?
  ```

- **Quiz Input**: “In the context of AI and job roles, which mindset does the video suggest as the most productive? (10 Points) * Denial, believing that AI cannot replace human jobs. * Panic, assuming AI will inevitably replace all human jobs. * Complete reliance on AI, assuming it will handle all tasks flawlessly. * Balanced positivity, leveraging AI to enhance human productivity.”
- **Output** (in a gray bubble):
  ```
  Chatbot: <strong>Balanced positivity, leveraging AI to enhance human productivity.</strong><br>Explanation: This mindset promotes collaboration between AI and humans, maximizing productivity without over-reliance or fear, which aligns with modern AI adoption strategies.
  ```

## Model Details
- **Name**: Qwen QwQ 32B (free)
- **Provider**: OpenRouter
- **Parameters**: 32 billion
- **Context Window**: 131,072 tokens
- **Cost**: $0/M input/output tokens (free tier, rate-limited)
- **Strengths**: Reasoning-focused, excels in complex tasks like quiz answering, math, and conversational personalization.
- **Source**: [OpenRouter QwQ 32B](https://openrouter.ai/qwen/qwq-32b:free)

## Notes
- **Rate Limits**: The free tier of QwQ 32B on OpenRouter has usage limits (e.g., ~100 requests/day). Check your OpenRouter dashboard for details.
- **Dependencies**: Only `flask` and `requests` are used—no local model hosting, so `transformers` and `torch` are not required.
- **Customization**: Modify `static/style.css` to change bubble colors, sizes, or add features like timestamps.
- **Local Model Removal**: Earlier versions used `distilgpt2` locally, but this project now relies entirely on the OpenRouter API, freeing up ~340 MB of disk space.

## Troubleshooting
- **No Response**: Ensure your OpenRouter API key is correct and you haven’t hit rate limits.
- **Styling Issues**: Check `static/style.css` for CSS conflicts or browser compatibility.
- **API Errors**: Look at the Flask logs in your terminal for error messages (e.g., “API Error: 429 - Too Many Requests”).

## Future Improvements
- Support for markdown rendering (e.g., lists, code blocks).
- Implement conversation history persistence.
