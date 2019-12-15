CREATE TABLE `customers` (
    `id`            int(10)     unsigned NOT NULL AUTO_INCREMENT,
    `first_name`    varchar(70)          NOT NULL,
    `last_name`     varchar(70)          NOT NULL,
    `email`         varchar(70)          NOT NULL,
    `created_date`  TIMESTAMP            NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_date`  TIMESTAMP            NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`)
);

INSERT INTO customers ( first_name, last_name, email)
VALUES (
    'Martin',
    'Müller',
    'martin@reachherotest.de'
), (
    'Julia',
    'Meyer',
    'julia.meyer@gmailtest.com'
), (
    'Dominik',
    'Schulz',
    'dominik.schulz@webtest.de'
), (
    'Christian',
    'Novak',
    'christian.novak@webtest.de'
), (
    'Roman',
    'Lehmann',
    'roman.lehmann@t-onlinetest.de'
), (
    'Alex',
    'Rittmann',
    'alex.rittmann@gmxtest.de'
), (
    'Anika',
    'Peter',
    'anika.peter@webtest.de'
)