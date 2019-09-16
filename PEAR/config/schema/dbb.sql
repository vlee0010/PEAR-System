create table units
(
    id int auto_increment
        primary key,
    title varchar(1000) not null,
    code varchar(10) not null,
    semester varchar(1) not null,
    year year not null
);


create table units_users
(
    unit_id int not null,
    user_id int not null,
    primary key (unit_id, user_id),
    constraint units_users_units_id_fk
        foreign key (unit_id) references units (id),
    constraint units_users_users_id_fk
        foreign key (user_id) references users (id)
);

create table teams
(
    id_ int auto_increment
        primary key,
    name varchar(255) not null
);

create table teams_users
(
    user_id int not null,
    team_id int not null,
    number int not null,
    constraint teams_users_pk
        primary key (user_id, team_id),
    constraint teams_users_teams_id__fk
        foreign key (team_id) references teams (id_),
    constraint teams_users_users_id_fk
        foreign key (user_id) references users (id)
);

create table peer_reviews
(
    id int auto_increment,
    date_start DATETIME not null,
    date_end DATETIME not null,
    date_reminder DATETIME not null,
    title VARCHAR(1000) not null,
    unit_id int not null,
    constraint peer_reviews_pk
        primary key (id),
    constraint peer_reviews_units_id_fk
        foreign key (unit_id) references units (id)
);

create table peer_reviews_teams
(
    peer_review_id int not null,
    team_id int not null,
    status BOOLEAN default 0 not null,
    constraint peer_review_team_pk
        primary key (peer_review_id, team_id)
);

create table peer_reviews_users
(
    peer_review_id int not null,
    user_id int not null,
    status BOOLEAN default 0 not null,
    constraint peer_reviews_users_pk
        primary key (user_id, peer_review_id),
    constraint peer_reviews_users_peer_reviews_id_fk
        foreign key (peer_review_id) references peer_reviews (id),
    constraint peer_reviews_users_users_id_fk
        foreign key (user_id) references users (id)
);



create table answers
(
    id int auto_increment,
    answer VARCHAR(1000) not null,
    constraint answers_pk
        primary key (id)
);

create table questions
(
    id int auto_increment,
    question VARCHAR(1000) not null,
    peer_review_id int not null,
    constraint questions_pk
        primary key (id),
    constraint questions_peer_reviews_id_fk
        foreign key (peer_review_id) references peer_reviews (id)
);

create table responses
(
    id int auto_increment,
    date_response DATETIME not null,
    user_id int not null,
    question_id int not null,
    answer_id int not null,
    constraint responses_pk
        primary key (id),
    constraint responses_answers_id_fk
        foreign key (answer_id) references answers (id),
    constraint responses_questions_id_fk
        foreign key (question_id) references questions (id),
    constraint responses_users_id_fk
        foreign key (user_id) references users (id)
);

-- Insert some dummy data to database for testing
INSERT INTO units(id, title, code, semester, year) VALUES
(1, 'Industry Experience','FIT3047','1',2019),
(2, 'Industry Experience','FIT3047','2', 2019),
(3, 'Ios application development', 'FIT3178','A',2019),
(4, 'Ios application development','FIT3178','A',2020);

INSERT INTO teams(id_, name) VALUES
(1,'Team123'), (2,'Team122');

-- Van, team 123, number of mem 2
INSERT INTO teams_users(user_id, team_id, number) VALUES
(13,1,2);

-- Van enrols in FIT3047 sem1 2019, FIT3178 semA 3178
INSERT INTO units_users(unit_id, user_id) VALUES
(1,13),(3,13);

-- FIT3047 sem1 2019 has 3 peer reviews listed below
INSERT INTO peer_reviews(id, date_start, date_end, date_reminder, title, unit_id) VALUES
(1,'2019-07-08 02:30:14', '2019-07-14 02:30:14','2018-07-12 02:30:14','Industry Experience Iteration 1 Peer Review',1),
(2,'2019-09-08 02:30:14', '2019-09-14 02:30:14','2018-09-12 02:30:14','Industry Experience Iteration 2 Peer Review',1),
(3,'2019-10-08 02:30:14', '2019-10-14 02:30:14','2018-10-12 02:30:14','Industry Experience Iteration 3 Peer Review',1);

-- 3 questions for FIT3047 sem1 2019 iteration1 peer reviews
INSERT INTO questions(id, question, peer_review_id) VALUES
(1,'Contribute to the teamwork',1),
(2,'Keeping the team on track',1),
(3,'Interactive with the team',1);

-- Answer score 1-5
INSERT INTO answers(id, answer) VALUES
(1,'1'),(2,'2'),(3,'3'),(4,'4'),(5,'5');

INSERT INTO peer_reviews_users(peer_review_id, user_id, status) VALUES
(1,13,0),(2,13,0),(3,13,0);

-- Van answer FIT3047 sem1 2019 iteration1 q1:5, q2:4, q3:1
INSERT INTO responses(id, date_response, user_id, question_id, answer_id) VALUES
(1,'2018-07-12 02:30:14',13,1,5),
(2,'2018-07-12 02:30:14',13,2,4),
(3,'2018-07-12 02:30:14',13,3,1);

-- FIT3047 sem1 2019 iteration1 peer reviews assigns to team123, team122
INSERT INTO peer_reviews_teams(peer_review_id, team_id) VALUES
(1,1),(1,2);






















