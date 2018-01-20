create table user (

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
