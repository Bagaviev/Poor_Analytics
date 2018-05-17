PROMPT Багавиев Б.И. ИУ4-83

PROMPT Удаление таблиц БД со всеми огранчениями для АСУ


DROP TABLE proizvodstvo CASCADE CONSTRAINTS;
DROP TABLE komplekt CASCADE CONSTRAINTS;
DROP TABLE osnastka CASCADE CONSTRAINTS;
DROP TABLE operation CASCADE CONSTRAINTS;
DROP TABLE personal CASCADE CONSTRAINTS;
DROP TABLE izdelie CASCADE CONSTRAINTS;


DROP SEQUENCE s_komplekt;
DROP SEQUENCE s_osnastka;
DROP SEQUENCE s_operation;
DROP SEQUENCE s_proizvodstvo;
DROP SEQUENCE s_personal;
DROP SEQUENCE s_izdelie;
