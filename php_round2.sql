/*
 * Ownego PHP Backend Candidates - Round 2
 * SQL Solutions
 */

-- Question 1: Write a sql query to find “number of employees working in each department who have salary > 7000”
SELECT 
    d.DEPT_NAME, 
    COUNT(e.EMP_ID) as employee_count
FROM Department d
JOIN Employee e ON d.DEPT_ID = e.DEPT_ID
WHERE e.EMP_SALARY > 7000
GROUP BY d.DEPT_NAME;

-- Question 2: Write a sql query to find “number of employees working in each department and average salary of department, exclude all departments with average salary <= 7000”
SELECT 
    d.DEPT_NAME, 
    COUNT(e.EMP_ID) as employee_count, 
    AVG(e.EMP_SALARY) as average_salary
FROM Department d
JOIN Employee e ON d.DEPT_ID = e.DEPT_ID
GROUP BY d.DEPT_NAME
HAVING AVG(e.EMP_SALARY) > 7000;