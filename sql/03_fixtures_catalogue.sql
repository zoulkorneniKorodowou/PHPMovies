USE `phpmovies`;

/*Insertion des categories*/
INSERT INTO
    `categories` (`id_category`, `name`, `slug`)
VALUES (1, 'Action', 'action'),
    (2, 'Drame', 'drame');

/*Insertion des réalisateurs*/
INSERT INTO
    `directors` (
        `id_director`,
        `name`,
        `bio`,
        `photo`
    )
VALUES (
        1,
        'Christopher Nolan',
        'Réalisateur, scénariste et producteur britannique reconnu pour ses récits non linéaires et ses superproductions complexes.',
        'https://static1.srcdn.com/wordpress/wp-content/uploads/2024/09/instar53477087.jpg'
    ),
    (
        2,
        'Steven Spielberg',
        'Cinéaste américain majeur, pionnier du blockbuster moderne et auteur de nombreux chefs-d''œuvre du cinéma mondial.',
        'https://www.parismatch.com/lmnr/img/var/pm/public/media/image/Steven-Spielberg.jpg?VersionId=SOOmjjCBVrdB78cVWrX1MuLQibx7NMXA'
    ),
    (
        3,
        'Frank Darabont',
        'Cinéaste américain réputé pour ses adaptations brillantes des œuvres de Stephen King.',
        'https://th.bing.com/th/id/R.2a19c42a98123756edd3a043d1866714?rik=yKG2HFwkN3FaWg&riu=http%3a%2f%2fwww.cinemapassion.com%2fphotos-personnalites%2fFrank-Darabont-photo-897.jpg&ehk=t2LRdhvGiIAMT%2f5VDkrpW2ljVVVQ%2fBnF3oB92ldnlR8%3d&risl=&pid=ImgRaw&r=0'
    ),
    (
        4,
        'Robert Zemeckis',
        'Réalisateur américain visionnaire, virtuose des effets spéciaux et des comédies dramatiques marquantes.',
        'https://luxlux.net/lux/wp-content/uploads/robert-zemeckis-2-1.jpeg'
    ),
    (
        5,
        'Francis Ford Coppola',
        'Figure centrale du Nouvel Hollywood, réalisateur de la légendaire trilogie du Parrain.',
        'https://content1.promiflash.de/article-images/square1024/francis-ford-coppola-bei-der-oscarverleihung-2022.jpg'
    ),
    (
        6,
        'David Fincher',
        'Maître du thriller psychologique, réputé pour sa mise en scène au millimètre et ses ambiances sombres.',
        'https://media.gq.com/photos/59ee399f98a70509f42ed93b/16:9/pass/david-fincher.jpg'
    ),
    (
        7,
        'Martin Scorsese',
        'Légende vivante du cinéma italo-américain, maître incontesté des drames et des récits de gangsters.',
        'https://static.independent.co.uk/2024/03/27/22/Martin_Scorsese_89809.jpg'
    ),
    (
        8,
        'Bong Joon-ho',
        'Réalisateur sud-coréen lauréat de la Palme d''or et de l''Oscar pour sa satire sociale percutante.',
        'https://tse2.mm.bing.net/th/id/OIP.pq3LvGCSgVT6Yw3yCfSXGQHaEs?r=0&rs=1&pid=ImgDetMain&o=7&rm=3'
    ),
    (
        9,
        'Lana Wachowski',
        'Cinéaste américaine révolutionnaire, créatrice avec sa sœur de la saga cyberpunk Matrix.',
        'https://tse3.mm.bing.net/th/id/OIP._Qzt557QSXVPI74JB6i_6AHaJ3?r=0&rs=1&pid=ImgDetMain&o=7&rm=3'
    ),
    (
        10,
        'Ridley Scott',
        'Réalisateur britannique majeur, créateur d''univers visuels inoubliables dans l''épopée historique et la SF.',
        'https://hips.hearstapps.com/hmg-prod/images/ridley-scott-gettyimages-1339598287.jpg?crop=0.9994444444444445xw:1xh;center,top&resize=640:*'
    ),
    (
        11,
        'George Miller',
        'Cinéaste australien visionnaire, créateur de l''univers post-apocalyptique survolté de Mad Max.',
        'https://m.media-amazon.com/images/M/MV5BMjE5Nzk1NzI5OV5BMl5BanBnXkFtZTgwMDAyMTQ5ODE@._V1_.jpg'
    ),
    (
        12,
        'Chad Stahelski',
        'Ancien coordinateur de cascades devenu réalisateur prodige de la saga John Wick.',
        'https://imgix.bustle.com/uploads/getty/2023/3/27/5b935bda-8334-40f3-abd0-dd96dd91dfc7-getty-1248357195.jpg?w=414&h=268&fit=crop&crop=faces&dpr=2'
    ),
    (
        13,
        'James Cameron',
        'Roi incontesté du box-office mondial et explorateur des nouvelles technologies cinématographiques.',
        'https://image.gala.de/22996180/t/II/v6/w960/r0.6667/-/james-cameron.jpg'
    ),
    (
        14,
        'Quentin Tarantino',
        'Auteur culte aux dialogues savoureux, expert des hommages cinéphiles et des scènes d''action explosives.',
        'https://tse4.mm.bing.net/th/id/OIP.mz1tKvkLy9w4Z2JvmwE3xAHaEK?r=0&rs=1&pid=ImgDetMain&o=7&rm=3'
    );

/*Insertion des films */
INSERT INTO
    `movies` (
        `id_movie`,
        `title`,
        `synopsis`,
        `release_year`,
        `duration`,
        `price`,
        `poster`,
        `trailer_youtube_id`,
        `director_id`,
        `category_id`,
        `created_at`
    )
VALUES
    /*actions*/
    (
        1,
        'The Dark Knight',
        'Batman, le lieutenant Jim Gordon et le procureur Harvey Dent s''allient pour éradiquer le crime à Gotham, mais se heurtent au Joker, un criminel psychopathe semant le chaos.',
        2008,
        152,
        14.99,
        'assets/images/posters/the_dark_night.jpg',
        'EXeTwQWrcwY',
        1,
        1,
        NOW() - INTERVAL 1 DAY
    ),
    (
        2,
        'Inception',
        'Dom Cobb est un voleur expérimenté capable de subtiliser les secrets les plus précieux enfouis au fond du subconscient pendant le sommeil. On lui propose une mission impossible : l''inception.',
        2010,
        148,
        13.99,
        'assets/images/posters/inception01.jpg',
        'YoHD9XEInc0',
        1,
        1,
        NOW() - INTERVAL 2 DAY
    ),
    (
        3,
        'Matrix',
        'Neo, un programmeur anonyme le jour et hacker la nuit, découvre grâce au mystérieux Morpheus que le monde réel n''est qu''une illusion informatique conçue par des machines.',
        1999,
        136,
        11.99,
        'assets/images/posters/matrix01.jpg',
        'm8e-C7tA38g',
        9,
        1,
        NOW() - INTERVAL 3 DAY
    ),
    (
        4,
        'Gladiator',
        'Le général romain Maximus est trahi lorsque Commode, le fils jaloux de l''empereur Marc Aurèle, assassine sa famille. Réduit en esclavage, Maximus devient gladiateur pour venger les siens.',
        2000,
        155,
        12.99,
        'assets/images/posters/gladiator01.jpg',
        'owK1qxDselE',
        10,
        1,
        NOW() - INTERVAL 4 DAY
    ),
    (
        5,
        'Mad Max: Fury Road',
        'Dans un monde post-apocalyptique désertique, Max Rockatansky s''associe à l''impératrice Furiosa pour fuir la tyrannie d''Immortan Joe à bord d''un camion-citerne de guerre.',
        2015,
        120,
        13.50,
        'assets/images/posters/mad_max.webp',
        'hEJnMQG562U',
        11,
        1,
        NOW() - INTERVAL 5 DAY
    ),
    (
        6,
        'John Wick',
        'Ancien tueur à gages d''élite ayant raccroché pour vivre en paix, John Wick replonge dans le milieu après que des mafieux russes ont volé sa Mustang et tué son chiot, dernier cadeau de sa femme défunte.',
        2014,
        101,
        10.99,
        'assets/images/posters/john_wick.jpg',
        '2AUmvWm5ZDQ',
        12,
        1,
        NOW() - INTERVAL 6 DAY
    ),
    (
        7,
        'Terminator 2 : Le Jugement Dernier',
        'Un nouveau cyborg perfectionné, le T-1000, est envoyé du futur pour éliminer John Connor enfant. Mais un autre Terminator reprogrammé est envoyé pour le protéger.',
        1991,
        137,
        11.50,
        'assets/images/posters/terminator_2.jpg',
        'CRRlbK5w8AE',
        13,
        1,
        NOW() - INTERVAL 7 DAY
    ),
    (
        8,
        'Il faut sauver le soldat Ryan',
        'Lors du débarquement de Normandie, le capitaine John Miller et son escouade reçoivent l''ordre périlleux de pénétrer derrière les lignes ennemies pour retrouver un soldat dont les trois frères sont morts au combat.',
        1998,
        169,
        12.99,
        'assets/images/posters/saving_private.webp',
        '9CiW_DbaaIM',
        2,
        1,
        NOW() - INTERVAL 8 DAY
    ),
    (
        9,
        'Pulp Fiction',
        'Les destins croisés de deux tueurs à gages bavards, d''un boxeur en cavale et d''un couple de braqueurs du dimanche dans les bas-fonds de Los Angeles.',
        1994,
        154,
        10.99,
        'assets/images/posters/pulp_fiction.webp',
        's7EdQ4FqbhY',
        14,
        1,
        NOW() - INTERVAL 9 DAY
    ),
    (
        10,
        'Blade Runner',
        'Dans un Los Angeles dystopique en 2019, Rick Deckard, un ancien policier appartenant à l''unité spéciale Blade Runner, est rappelé pour traquer et éliminer quatre réplicants rebelles.',
        1982,
        117,
        12.50,
        'assets/images/posters/blade_runner.webp',
        'eogpZs26sU4',
        10,
        1,
        NOW() - INTERVAL 10 DAY
    ),
    /*Drames*/
    (
        11,
        'Interstellar',
        'Une équipe d''explorateurs spatiaux voyage à travers un trou de ver récemment découvert afin de trouver une nouvelle planète habitable pour sauver l''Humanité d''une Terre mourante.',
        2014,
        169,
        14.99,
        'assets/images/posters/interstellar01.jpg',
        'zSWdZVtXT7E',
        1,
        2,
        NOW() - INTERVAL 11 DAY
    ),
    (
        12,
        'Oppenheimer',
        'Le physicien J. Robert Oppenheimer dirige le projet Manhattan secret à Los Alamos pour concevoir la première arme nucléaire de l''Histoire, avant d''être hanté par les conséquences morales de sa création.',
        2023,
        180,
        15.99,
        'assets/images/posters/oppenheimer01.webp',
        'uYPbbksJxIg',
        1,
        2,
        NOW() - INTERVAL 12 DAY
    ),
    (
        13,
        'Les Évadés',
        'Condamné à perpétuité pour un double meurtre qu''il clame ne pas avoir commis, le banquier Andy Dufresne noue une amitié indéfectible avec Red au cœur de la terrible prison d''État de Shawshank.',
        1994,
        142,
        11.99,
        'assets/images/posters/the_shawshank_redemption.webp',
        'PLl99DlL6b4',
        3,
        2,
        NOW() - INTERVAL 13 DAY
    ),
    (
        14,
        'La Ligne verte',
        'Paul Edgecomb, gardien-chef du couloir de la mort dans les années 1930, fait la rencontre de John Coffey, un colosse noir condamné à mort doté d''un mystérieux pouvoir de guérison miraculeux.',
        1999,
        189,
        12.99,
        'assets/images/posters/the_green_mile01.webp',
        'Ki4haFrqSrw',
        3,
        2,
        NOW() - INTERVAL 14 DAY
    ),
    (
        15,
        'Forrest Gump',
        'Forrest Gump, un homme au quotient intellectuel limité mais au cœur pur, traverse sans s''en rendre compte les plus grands événements de l''histoire contemporaine des États-Unis au XXe siècle.',
        1994,
        142,
        11.99,
        'assets/images/posters/forrest_gump01.webp',
        'bLvqoHBiiW8',
        4,
        2,
        NOW() - INTERVAL 15 DAY
    ),
    (
        16,
        'La Liste de Schindler',
        'Pendant la Seconde Guerre mondiale en Pologne, l''industriel allemand Oskar Schindler utilise sa fortune et son usine d''émaillerie pour sauver plus de mille Juifs de la déportation.',
        1993,
        195,
        13.99,
        'assets/images/posters/schindlers_list01.jpg',
        'gG22XNhtnoY',
        2,
        2,
        NOW() - INTERVAL 16 DAY
    ),
    (
        17,
        'Le Parrain',
        'À New York en 1945, Don Vito Corleone dirige l''une des cinq familles mafieuses les plus puissantes de la ville. Lorsque le patriarche est attaqué, son plus jeune fils Michael est contraint de prendre la relève.',
        1972,
        175,
        13.50,
        'assets/images/posters/the_godfather01.webp',
        'sY1S34973zA',
        5,
        2,
        NOW() - INTERVAL 17 DAY
    ),
    (
        18,
        'Fight Club',
        'Un employé de bureau insomniaque et désabusé fait la rencontre de Tyler Durden, un fabricant de savon anarchiste. Ensemble, ils fondent le Fight Club, un cercle de combat clandestin.',
        1999,
        139,
        11.50,
        'assets/images/posters/figth_club01.jpg',
        'qtRKdVHc-cE',
        6,
        2,
        NOW() - INTERVAL 18 DAY
    ),
    (
        19,
        'Les Affranchis',
        'Depuis son plus jeune âge dans le quartier new-yorkais de Brooklyn, Henry Hill rêve d''une seule chose : devenir un gangster respecté et craint au sein de la mafia italo-américaine.',
        1990,
        146,
        12.50,
        'assets/images/posters/good_fellas01.webp',
        'qo5jJpHtTX8',
        7,
        2,
        NOW() - INTERVAL 19 DAY
    ),
    (
        20,
        'Parasite',
        'La famille de Ki-taek, au chômage et vivant dans un sous-sol précaire, use de ruse pour se faire engager tour à tour au service de la richissime famille Park, déclenchant un engrenage incontrôlable.',
        2019,
        132,
        13.99,
        'assets/images/posters/parasite01.webp',
        '5xH0hhJLEEQ',
        8,
        2,
        NOW() - INTERVAL 20 DAY
    );