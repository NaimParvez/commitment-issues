from pydantic import BaseModel

class CourseRequest(BaseModel):
    course_name: str
    duration: str
    level: str
    purpose: str

class CourseRoadmap(BaseModel):
    roadmap: str
    duration: str
    level: str
    course_name: str