CREATE TABLE players (
    MemberID int,
    FirstName varchar(20),
    FamilyName varchar(20),
	Email varchar(40),
	Phone int,
	PRIMARY KEY (MemberID)
);

CREATE TABLE board_games (
    Boardgame varchar(20),
	MemberID int,
	PRIMARY KEY (Boardgame)
);

CREATE TABLE board_games_assigned (
    Boardgame varchar(20),
	MemberID int,
    AssignDate date,
	Event varchar(30),
	PRIMARY KEY (Boardgame)
);

CREATE TABLE schedule (
    Venue varchar(200),
	Date date,
	Time time,
	PRIMARY KEY (Venue)
);

CREATE TABLE scoring (
    Boardgame varchar(20),
	MemberID int,
	Score int,
	Date date,
	PRIMARY KEY (Boardgame)
);


