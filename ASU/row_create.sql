PROMPT �������� �.�. ��4-83
PROMPT ������ ��������� �������� � ������� ��

INSERT INTO personal (per_id, per_name, per_surname, per_stazh, per_tel, per_spec, per_type, per_log, per_pass)
VALUES (1,'�����','��������',8,11111111,'�������','adm', 'bulat', '1111');
INSERT INTO personal (per_id, per_name, per_surname, per_stazh, per_tel, per_spec, per_type, per_log, per_pass)
VALUES (2,'����','������',2,33333333,'�������','usr', 'ivan', '2222');
INSERT INTO personal (per_id, per_name, per_surname, per_stazh, per_tel, per_spec, per_type, per_log, per_pass)
VALUES (3,'�������','�������',5,22222222,'��������','usr', 'kola', '3333');
INSERT INTO personal (per_id, per_name, per_surname, per_stazh, per_tel, per_spec, per_type, per_log, per_pass)
VALUES (4,'������','������',4,44444444,'��������','usr', 'serg', '4444');

INSERT INTO operation (op_id, op_name)
VALUES (1,'��������������');
INSERT INTO operation (op_id, op_name)
VALUES (2,'��������� ���������');
INSERT INTO operation (op_id, op_name)
VALUES (3,'�����');
INSERT INTO operation (op_id, op_name)
VALUES (4,'��������');

INSERT INTO izdelie (izd_id, izd_partno, izd_no)
VALUES (1, 1, 1);

INSERT INTO osnastka (os_op_id, os_id, os_name)
VALUES (2, 1,'������');
INSERT INTO osnastka (os_op_id, os_id, os_name)
VALUES (3, 2,'��������');
INSERT INTO osnastka (os_op_id, os_id, os_name)
VALUES (4, 3,'����������� �����');

INSERT INTO komplekt (kom_op_id, kom_id, kom_name, kom_note, kom_kolvo)
VALUES (1, 1,'��������','���',4);
INSERT INTO komplekt (kom_op_id, kom_id, kom_name, kom_note, kom_kolvo)
VALUES (1, 2,'�����������','���',2);
INSERT INTO komplekt (kom_op_id, kom_id, kom_name, kom_note, kom_kolvo)
VALUES (4, 3,'�����','���',6);

INSERT INTO proizvodstvo (pr_op_id, pr_per_id, pr_izd_id, pr_id, pr_note, pr_date, pr_brname, pr_brreason)
VALUES (1, 2, 1, 1,'��','10.01.00', ' ', ' ');
INSERT INTO proizvodstvo (pr_op_id, pr_per_id, pr_izd_id, pr_id, pr_note, pr_date, pr_brname, pr_brreason)
VALUES (2, 2, 1, 2,'��','10.01.00', ' ', ' ');
INSERT INTO proizvodstvo (pr_op_id, pr_per_id, pr_izd_id, pr_id, pr_note, pr_date, pr_brname, pr_brreason)
VALUES (3, 3, 1, 3,'��','10.01.00','������� ��������������','���� ���������');
INSERT INTO proizvodstvo (pr_op_id, pr_per_id, pr_izd_id, pr_id, pr_note, pr_date, pr_brname, pr_brreason)
VALUES (4, 4, 1, 4,'��','10.01.00', ' ', ' ');


COMMIT;


