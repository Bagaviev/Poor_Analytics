SPOOL c:\sql\db_create.lst

PROMPT Багавиев Б.И. ИУ4-83
PROMPT Создание таблиц БД с необходмымими компонентами для АСУ

PROMPT ------ 1 Создание таблиц и первичных ключей ------

CREATE TABLE personal
(
	per_id       INTEGER NOT NULL,
	per_name     VARCHAR2(15),
	per_surname  VARCHAR2(15),
	per_stazh    INTEGER,
	per_tel      INTEGER,
	per_spec     VARCHAR2(15),
	per_type     VARCHAR2(10),
	per_log      VARCHAR2(10),
	per_pass     VARCHAR2(10)
);

CREATE UNIQUE INDEX i_personal ON personal (per_id);

ALTER TABLE personal
ADD (CONSTRAINT  i_personal PRIMARY KEY (per_id));

CREATE TABLE komplekt
(
	kom_id       INTEGER NOT NULL,
	kom_op_id    INTEGER,
	kom_note     VARCHAR2(50),
	kom_kolvo    INTEGER,
	kom_cost     INTEGER,
	kom_name     VARCHAR2(15)
);

CREATE UNIQUE INDEX i_komplekt ON komplekt (kom_id);

ALTER TABLE komplekt
ADD (CONSTRAINT i_komplekt PRIMARY KEY (kom_id));

CREATE TABLE operation
(
	op_id        INTEGER NOT NULL,
	op_name      VARCHAR2(30),
	op_note      VARCHAR2(50)
);

CREATE UNIQUE INDEX i_operation ON operation (op_id);

ALTER TABLE operation
ADD (CONSTRAINT i_operation PRIMARY KEY (op_id));

CREATE TABLE osnastka
(
	os_id        INTEGER NOT NULL,
	os_op_id     INTEGER, 
	os_note      VARCHAR2(50),
	os_name      VARCHAR2(30)
);

CREATE UNIQUE INDEX i_osnastka ON osnastka (os_id);

ALTER TABLE osnastka
ADD (CONSTRAINT i_osnastka PRIMARY KEY (os_id));

CREATE TABLE proizvodstvo
(
	pr_id        INTEGER NOT NULL,
	pr_op_id     INTEGER,
	pr_per_id    INTEGER,
	pr_izd_id    INTEGER,
	pr_note      VARCHAR2(15),
	pr_date      DATE,
	pr_brname    VARCHAR2(50),
	pr_brreason  VARCHAR2(50)
);

CREATE UNIQUE INDEX i_proizvodstvo ON proizvodstvo (pr_id);

ALTER TABLE proizvodstvo
ADD (CONSTRAINT i_proizvodstvo PRIMARY KEY (pr_id));


CREATE TABLE izdelie
(
	izd_id       INTEGER NOT NULL,
	izd_partno   INTEGER,
	izd_no       INTEGER,
	izd_note     VARCHAR2(50)
);

CREATE UNIQUE INDEX i_izdelie ON izdelie (izd_id);

ALTER TABLE izdelie
ADD (CONSTRAINT i_izdelie PRIMARY KEY (izd_id));


PROMPT ------ 2 Создание вторичных ключей ------

CREATE INDEX i_kom_op ON komplekt (kom_op_id);
ALTER TABLE komplekt
ADD (CONSTRAINT i_kom_op FOREIGN KEY (kom_op_id) REFERENCES operation (op_id));

CREATE INDEX i_os_op ON osnastka (os_op_id);
ALTER TABLE osnastka
ADD (CONSTRAINT i_os_op FOREIGN KEY (os_op_id) REFERENCES operation (op_id));

CREATE INDEX i_pr_op ON proizvodstvo (pr_op_id);
ALTER TABLE proizvodstvo
ADD (CONSTRAINT i_pr_op FOREIGN KEY (pr_op_id) REFERENCES operation (op_id));

CREATE INDEX i_pr_per ON proizvodstvo (pr_per_id);
ALTER TABLE proizvodstvo
ADD (CONSTRAINT i_pr_per FOREIGN KEY (pr_per_id) REFERENCES personal (per_id));

CREATE INDEX i_pr_izd ON proizvodstvo (pr_izd_id);
ALTER TABLE proizvodstvo
ADD (CONSTRAINT i_pr_izd FOREIGN KEY (pr_izd_id) REFERENCES izdelie (izd_id));



PROMPT ------ 3 Создание триггеров и последовательностей для вставки ID -----

CREATE SEQUENCE s_personal;

CREATE OR REPLACE TRIGGER t_personal
BEFORE INSERT ON personal FOR EACH ROW
BEGIN
	SELECT s_personal.nextval
	INTO :new.per_id
	FROM dual;
END;
/

CREATE SEQUENCE s_komplekt;

CREATE OR REPLACE TRIGGER t_komplekt
BEFORE INSERT ON komplekt FOR EACH ROW
BEGIN
	SELECT s_komplekt.nextval
	INTO :new.kom_id
	FROM dual;
END;
/

CREATE SEQUENCE s_osnastka;

CREATE OR REPLACE TRIGGER t_osnastka
BEFORE INSERT ON osnastka FOR EACH ROW
BEGIN
	SELECT s_osnastka.nextval
	INTO :new.os_id
	FROM dual;
END;
/

CREATE SEQUENCE s_operation;

CREATE OR REPLACE TRIGGER t_operation
BEFORE INSERT ON operation FOR EACH ROW
BEGIN
	SELECT s_operation.nextval
	INTO :new.op_id
	FROM dual;
END;
/

CREATE SEQUENCE s_proizvodstvo;

CREATE OR REPLACE TRIGGER t_proizvodstvo
BEFORE INSERT ON proizvodstvo FOR EACH ROW
BEGIN
	SELECT s_proizvodstvo.nextval
	INTO :new.pr_id
	FROM dual;
END;
/


CREATE SEQUENCE s_izdelie;

CREATE OR REPLACE TRIGGER t_izdelie
BEFORE INSERT ON izdelie FOR EACH ROW
BEGIN
	SELECT s_izdelie.nextval
	INTO :new.izd_id
	FROM dual;
END;
/


PROMPT ------ 4 Создание триггеров, обеспечивающих ссылочную целостность ------

CREATE OR REPLACE TRIGGER t_kom_op
BEFORE DELETE ON operation FOR EACH ROW
BEGIN
	DELETE FROM komplekt WHERE kom_op_id = :old.op_id;
END;
/

CREATE OR REPLACE TRIGGER t_os_op
BEFORE DELETE ON operation FOR EACH ROW
BEGIN
	DELETE FROM osnastka WHERE os_op_id = :old.op_id;
END;
/

CREATE OR REPLACE TRIGGER t_pr_op
BEFORE DELETE ON operation FOR EACH ROW
BEGIN
	DELETE FROM proizvodstvo WHERE pr_op_id = :old.op_id;
END;
/

CREATE OR REPLACE TRIGGER t_pr_per
BEFORE DELETE ON personal FOR EACH ROW
BEGIN
	DELETE FROM proizvodstvo WHERE pr_per_id = :old.per_id;
END;
/

CREATE OR REPLACE TRIGGER t_pr_izd
BEFORE DELETE ON izdelie FOR EACH ROW
BEGIN
	DELETE FROM proizvodstvo WHERE pr_izd_id = :old.izd_id;
END;
/


SPOOL OFF




	 