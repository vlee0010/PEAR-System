create table peer_reviews_teams
(
    peer_review_id int not null,
    team_id int not null,
    status tinyint(1) default 0 not null,
    primary key (peer_review_id, team_id)
);

create table questions
(
    id int auto_increment
        primary key,
    description varchar(1000) not null
);

create table units
(
    id int auto_increment
        primary key,
    title varchar(1000) not null,
    code varchar(10) not null,
    semester varchar(1) not null,
    year year not null
);

create table peer_reviews
(
    id int auto_increment
        primary key,
    date_start datetime not null,
    date_end datetime not null,
    date_reminder datetime not null,
    title varchar(1000) not null,
    unit_id int not null,
    constraint peer_reviews_units_id_fk
        foreign key (unit_id) references units (id)
);

create table teams
(
    id_ int auto_increment
        primary key,
    name varchar(255) not null,
    unit_id int not null,
    constraint FK_teamunit
        foreign key (unit_id) references units (id)
);

create table users
(
    id int auto_increment
        primary key,
    firstname varchar(255) not null,
    lastname varchar(255) not null,
    email varchar(255) not null,
    created datetime null,
    modified datetime null,
    role varchar(255) null,
    password varchar(255) not null,
    verified int null,
    token varchar(255) null
);

create table peer_reviews_users
(
    peer_review_id int not null,
    user_id int not null,
    status tinyint(1) default 0 not null,
    primary key (user_id, peer_review_id),
    constraint peer_reviews_users_peer_reviews_id_fk
        foreign key (peer_review_id) references peer_reviews (id),
    constraint peer_reviews_users_users_id_fk
        foreign key (user_id) references users (id)
);

create table responses
(
    id int auto_increment
        primary key,
    date_response datetime not null,
    user_id int not null,
    question_id int not null,
    ratee_id int not null,
    rate_text varchar(1000) default '' null,
    rate_number int null,
    is_text_number tinyint(1) not null,
    constraint responses_questions_id_fk
        foreign key (question_id) references questions (id),
    constraint responses_users_id_fk
        foreign key (user_id) references users (id)
);

create table answers
(
    id int auto_increment
        primary key,
    answer varchar(1000) not null,
    user_id int not null,
    response_id int not null,
    constraint answers_responses_id_fk
        foreign key (response_id) references responses (id),
    constraint answers_users_id_fk
        foreign key (user_id) references users (id)
);

create table teams_users
(
    user_id int not null,
    team_id int not null,
    number int not null,
    primary key (user_id, team_id),
    constraint teams_users_teams_id__fk
        foreign key (team_id) references teams (id_),
    constraint teams_users_users_id_fk
        foreign key (user_id) references users (id)
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

