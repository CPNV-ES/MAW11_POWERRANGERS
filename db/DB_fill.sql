USE `exercise-looper` ;

-- -----------------------------------------------------
-- Table `exercise-looper`.`exercises`
-- -----------------------------------------------------
insert into exercises (id, name) values (1, 'Tax Accountant');
insert into exercises (id, name) values (2, 'Safety Technician II');
insert into exercises (id, name) values (3, 'Geologist I');
insert into exercises (id, name) values (4, 'Structural Analysis Engineer');
insert into exercises (id, name) values (5, 'Physical Therapy Assistant');
insert into exercises (id, name) values (6, 'Web Designer III');
insert into exercises (id, name) values (7, 'Teacher');
insert into exercises (id, name) values (8, 'Quality Engineer');
insert into exercises (id, name) values (9, 'Speech Pathologist');
insert into exercises (id, name) values (10, 'Human Resources Assistant III');
insert into exercises (id, name) values (11, 'Professor');
insert into exercises (id, name) values (12, 'Analog Circuit Design manager');
insert into exercises (id, name) values (13, 'Administrative Assistant III');
insert into exercises (id, name) values (14, 'Payment Adjustment Coordinator');
insert into exercises (id, name) values (15, 'Registered Nurse');
insert into exercises (id, name) values (16, 'Data Coordinator');
insert into exercises (id, name) values (17, 'Office Assistant II');
insert into exercises (id, name) values (18, 'Nuclear Power Engineer');
insert into exercises (id, name) values (19, 'Environmental Specialist');
insert into exercises (id, name) values (20, 'Account Coordinator');
insert into exercises (id, name) values (21, 'Budget/Accounting Analyst IV');
insert into exercises (id, name) values (22, 'Project Manager');
insert into exercises (id, name) values (23, 'Nuclear Power Engineer');
insert into exercises (id, name) values (24, 'Geologist II');
insert into exercises (id, name) values (25, 'Recruiter');


-- -----------------------------------------------------
-- Table `exercise-looper`.`fieldTypes`
-- -----------------------------------------------------
insert into fieldTypes (id, name) values (1, 'Single line text');
insert into fieldTypes (id, name) values (2, 'List of single lines');
insert into fieldTypes (id, name) values (3, 'Multi-line text');


-- -----------------------------------------------------
-- Table `exercise-looper`.`fields`
-- -----------------------------------------------------
insert into fields (id, name, exercises_id, fieldTypes_id) values (1, 'Donec semper sapien a libero.', 6, 3);
insert into fields (id, name, exercises_id, fieldTypes_id) values (2, 'Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.', 16, 3);
insert into fields (id, name, exercises_id, fieldTypes_id) values (3, 'Morbi non lectus.', 12, 1);
insert into fields (id, name, exercises_id, fieldTypes_id) values (4, 'Nam dui.', 6, 3);
insert into fields (id, name, exercises_id, fieldTypes_id) values (5, 'Curabitur at ipsum ac tellus semper interdum.', 10, 3);
insert into fields (id, name, exercises_id, fieldTypes_id) values (6, 'Fusce posuere felis sed lacus.', 4, 2);
insert into fields (id, name, exercises_id, fieldTypes_id) values (7, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam.', 3, 2);
insert into fields (id, name, exercises_id, fieldTypes_id) values (8, 'Aenean auctor gravida sem.', 21, 2);
insert into fields (id, name, exercises_id, fieldTypes_id) values (9, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi.', 22, 1);
insert into fields (id, name, exercises_id, fieldTypes_id) values (10, 'Morbi non lectus.', 10, 1);
insert into fields (id, name, exercises_id, fieldTypes_id) values (11, 'Nulla justo.', 22, 3);
insert into fields (id, name, exercises_id, fieldTypes_id) values (12, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi.', 22, 1);
insert into fields (id, name, exercises_id, fieldTypes_id) values (13, 'Vestibulum ac est lacinia nisi venenatis tristique.', 12, 1);
insert into fields (id, name, exercises_id, fieldTypes_id) values (14, 'Vivamus in felis eu sapien cursus vestibulum.', 5, 2);
insert into fields (id, name, exercises_id, fieldTypes_id) values (15, 'Vestibulum quam sapien, varius ut, blandit non, interdum in, ante.', 23, 3);
insert into fields (id, name, exercises_id, fieldTypes_id) values (16, 'Integer ac neque.', 23, 3);
insert into fields (id, name, exercises_id, fieldTypes_id) values (17, 'In est risus, auctor sed, tristique in, tempus sit amet, sem.', 16, 1);
insert into fields (id, name, exercises_id, fieldTypes_id) values (18, 'Sed sagittis.', 21, 3);
insert into fields (id, name, exercises_id, fieldTypes_id) values (19, 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', 1, 3);
insert into fields (id, name, exercises_id, fieldTypes_id) values (20, 'Pellentesque eget nunc.', 8, 3);
insert into fields (id, name, exercises_id, fieldTypes_id) values (21, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est.', 20, 1);
insert into fields (id, name, exercises_id, fieldTypes_id) values (22, 'In hac habitasse platea dictumst.', 15, 2);
insert into fields (id, name, exercises_id, fieldTypes_id) values (23, 'Vivamus in felis eu sapien cursus vestibulum.', 7, 3);
insert into fields (id, name, exercises_id, fieldTypes_id) values (24, 'Curabitur in libero ut massa volutpat convallis.', 8, 3);
insert into fields (id, name, exercises_id, fieldTypes_id) values (25, 'Sed sagittis.', 13, 2);
