CREATE TABLE Käyttäjä(
	ktunnus SERIAL PRIMARY KEY,
	käyttäjätunnus varchar(50) NOT NULL,
	salasana varchar(50) NOT NULL
);

CREATE TABLE Askare(
	atunnus SERIAL PRIMARY KEY,
	ktunnus INTEGER REFERENCES Käyttäjä(ktunnus),
	nimi varchar(50) NOT NULL,
	tärkeysaste INTEGER DEFAULT 1,
	deadline DATE
);

CREATE TABLE Luokka(
	ltunnus SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL
);

CREATE TABLE Askareenluokka(
	altunnus SERIAL PRIMARY KEY,
	atunnus INTEGER REFERENCES Askare(atunnus),
	ltunnus INTEGER REFERENCES Luokka(ltunnus)
);
