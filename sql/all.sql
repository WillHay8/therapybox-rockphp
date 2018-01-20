create database therapybox_rock_php;

create table user (
    id mediumint not null auto_increment,
    username varchar(255),
    email varchar(255),
    password_hash varchar(255),
    date_signed_up datetime,
    primary key id,
);

create table task (
    id mediumint not null auto_increment,
    user_id mediumint not null,
    title text,
    complete boolean,
    date_created datetime not null,
    date_completed datetime,
    primary key id,
    foreign key user_id references user(id) on delete cascade on update cascade
);
