PROMPT Багавиев Б.И. ИУ4-83

PROMPT Функция подсчета количества брака

SPOOL c:\sql\function.lst

CREATE OR REPLACE FUNCTION fk(id INTEGER)
RETURN INTEGER AS
	kolvo INTEGER;
	a proizvodstvo.pr_id%TYPE;
        CURSOR c_st(id INTEGER) IS
	SELECT pr_id
	FROM proizvodstvo
	WHERE pr_per_id = id;
BEGIN
	kolvo := 0;
	OPEN c_st(id);
	FETCH c_st INTO a;
	WHILE c_st%FOUND
		LOOP
			kolvo := kolvo + 1;
			FETCH c_st INTO a;
		END LOOP;
	RETURN kolvo;
	CLOSE c_st;
END;
/

SPOOL OFF
	