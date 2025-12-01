import google.generativeai as genai

genai.configure(api_key="add your api key")
model = genai.GenerativeModel("gemini-1.5-flash")
response = model.generate_content("generate a learning path of python for beginners that can be completed in 2 weeks")
print(response.text)
