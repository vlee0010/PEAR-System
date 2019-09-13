create table pear_schema.students
(
    id int auto_increment
        primary key,
    fname varchar(255) not null,
    lname varchar(255) not null,
    email varchar(255) not null,
    password varchar(255) not null
);

create table pear_schema.enrollments
(
    id int auto_increment
        primary key,
    unit varchar(255) not null,
    code varchar(10) not null,
    semester int not null,
    year date not null,
    student_id int not null
);

create index enrollments_students_id_fk
    on pear_schema.enrollments (student_id);

create table pear_schema.questions
(
    id int auto_increment,
    question VARCHAR(255) not null,
    constraint questions_pk
        primary key (id)
);

create table pear_schema.peer_reviews
(
    id int auto_increment,
    date_start DATETIME not null,
    date_end DATETIME not null,
    date_reminder DATETIME not null,
    title VARCHAR(1000) not null,
    question_id int not null,
    constraint peer_reviews_pk
        primary key (id, question_id),
    constraint peer_reviews_questions_id_fk
        foreign key (question_id) references pear_schema.questions (id)
);


create table pear_schema.responses
(
    id int auto_increment,
    date_response DATETIME not null,
    response VARCHAR(2000) not null,
    peer_review_id int not null,
    student_id int not null,
    constraint responses_pk
        primary key (id),
    constraint responses_peer_reviews_id_fk
        foreign key (peer_review_id) references pear_schema.peer_reviews (id),
    constraint responses_students_id_fk
        foreign key (student_id) references pear_schema.students (id)
);









