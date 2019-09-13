create table Units
(
    id int auto_increment,
    title VARCHAR(1000) not null,
    semester VARCHAR(1) not null,
    year DATE not null,
    constraint Units_pk
        primary key (id)
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

















