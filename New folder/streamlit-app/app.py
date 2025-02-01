import streamlit as st
import google.generativeai as genai
import os
from dotenv import load_dotenv  # Import dotenv

# Load environment variables from .env file
load_dotenv()

# Configure the Gemini API using the stored API key
gemini_api_key = os.getenv('GEMINI_API_KEY')

if not gemini_api_key:
    st.error("API key not found! Please check your .env file.")
else:
    genai.configure(api_key=gemini_api_key)

def generate_course_roadmap(course_name, duration, level, purpose):
    model = genai.GenerativeModel("gemini-1.5-flash")
    prompt = f"Generate a course roadmap with the link of course material for '{course_name}' with a duration of '{duration}', level '{level}', and purpose '{purpose}'."
    response = model.generate_content(prompt)
    return response.text

def main():
    st.title("Course Roadmap Generator")
    
    course_name = st.text_input("Course Name")
    duration = st.text_input("Duration (e.g., 2 weeks)")
    level = st.selectbox("Level", ["Beginner", "Intermediate", "Advanced"])
    purpose = st.text_area("Purpose of Learning")
    
    if st.button("Generate Roadmap"):
        if course_name and duration and purpose:
            roadmap = generate_course_roadmap(course_name, duration, level, purpose)
            st.subheader("Generated Course Roadmap")
            st.write(roadmap)
        else:
            st.error("Please fill in all fields.")

if __name__ == "__main__":
    main()
