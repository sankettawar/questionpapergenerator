Generating the question paper was he main aim of this project hence more work is implemented in that area,though some of the functions may not work properly but given the time I have tried my best for the project.
Random institute name is taken under consideration in this aspect as the logo was available on google.
Tried to reach every aspect for the given task, including security aspect, semester, ID for teacher to login,administrator id,and question paper generated at the end.
For login as faculty, refer the faculty id from the database.
All the entries are imaginary.






# QuestionPaperGen

Automatic Question Paper Generator is a project that generates questions papers for both Continous Internal Evaluation and Semester End Examinations using an algorithm that fetches questions
 from the database (entered by the teacher) for a given set of requirements by the faculty. 
 
 The features include:

# Administrator

1. Can add a new faculty.
2. Can assign a subject to a faculty for a particular academic year.
3. Can add a new evauation to the database. (CIE/SEE)
4. Add new courses and update syllabus for the same.
5. Generate various reports including subeject composition in the questions database, level of difficulty composition, Update history, Login History, etc.,
6. Approve a questions paper generated by the faculty for a particular evaluation.
7. Add another administrator.
8. Add Course Outcomes to courses.
etc.,

# Faculty

1. Add / Edit questions for his/her course.
2. Generate a new question paper for an evaluation specified by the Administrator. (CIE/SEE).
3. Refer to previously generated papers for his/her course.
4. Check the syllabus of his/her courses.
5. Check course outcomes of his/her courses.
Etc.,

#Security Aspects 

1. Questions are encrypted using AES-256 bit encryption.
2. Passwords are hashed using MD-5 hashing algorithm
3. Update/Login History
4. re-Captcha from Google:Currently is not working properly,yet kept it in thr form because it looks fancy.
5. Session-timeouts




