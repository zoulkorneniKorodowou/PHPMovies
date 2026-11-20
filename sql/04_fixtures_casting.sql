USE `phpmovies`;

INSERT INTO `actors` (`id_actor`, `name`) VALUES
    (1, 'Christian Bale'),
    (2, 'Heath Ledger'),
    (3, 'Leonardo DiCaprio'),
    (4, 'Joseph Gordon-Levitt'),
    (5, 'Keanu Reeves'),
    (6, 'Laurence Fishburne'),
    (7, 'Carrie-Anne Moss'),
    (8, 'Russell Crowe'),
    (9, 'Joaquin Phoenix'),
    (10, 'Tom Hardy'),
    (11, 'Charlize Theron'),
    (12, 'Willem Dafoe'),
    (13, 'Arnold Schwarzenegger'),
    (14, 'Linda Hamilton'),
    (15, 'Tom Hanks'),
    (16, 'Matt Damon'),
    (17, 'John Travolta'),
    (18, 'Samuel L. Jackson'),
    (19, 'Uma Thurman'),
    (20, 'Harrison Ford'),
    (21, 'Rutger Hauer'),
    (22, 'Matthew McConaughey'),
    (23, 'Anne Hathaway'),
    (24, 'Jessica Chastain'),
    (25, 'Cillian Murphy'),
    (26, 'Emily Blunt'),
    (27, 'Robert Downey Jr.'),
    (28, 'Tim Robbins'),
    (29, 'Morgan Freeman'),
    (30, 'Michael Clarke Duncan'),
    (31, 'David Morse'),
    (32, 'Robin Wright'),
    (33, 'Gary Sinise'),
    (34, 'Liam Neeson'),
    (35, 'Ralph Fiennes'),
    (36, 'Ben Kingsley'),
    (37, 'Marlon Brando'),
    (38, 'Al Pacino'),
    (39, 'James Caan'),
    (40, 'Brad Pitt'),
    (41, 'Edward Norton'),
    (42, 'Helena Bonham Carter'),
    (43, 'Ray Liotta'),
    (44, 'Robert De Niro'),
    (45, 'Joe Pesci'),
    (46, 'Song Kang-ho'),
    (47, 'Choi Woo-shik'),
    (48, 'Park So-dam'),
    (49, 'Michael Caine');

/* Liaisons film <-> acteurs (movie_id, actor_id) */
INSERT INTO `movie_actor` (`movie_id`, `actor_id`) VALUES
    /* Action */
    (1, 1), (1, 2), (1, 49),                    -- The Dark Knight
    (2, 3), (2, 4), (2, 10), (2, 25), (2, 49),  -- Inception
    (3, 5), (3, 6), (3, 7),                     -- Matrix
    (4, 8), (4, 9),                             -- Gladiator
    (5, 10), (5, 11),                           -- Mad Max: Fury Road
    (6, 5), (6, 12),                            -- John Wick
    (7, 13), (7, 14),                           -- Terminator 2
    (8, 15), (8, 16),                           -- Il faut sauver le soldat Ryan
    (9, 17), (9, 18), (9, 19),                  -- Pulp Fiction
    (10, 20), (10, 21),                         -- Blade Runner
    /* Drames */
    (11, 22), (11, 23), (11, 24), (11, 16), (11, 49), -- Interstellar
    (12, 25), (12, 26), (12, 27),               -- Oppenheimer
    (13, 28), (13, 29),                         -- Les Évadés
    (14, 15), (14, 30), (14, 31),               -- La Ligne verte
    (15, 15), (15, 32), (15, 33),               -- Forrest Gump
    (16, 34), (16, 35), (16, 36),               -- La Liste de Schindler
    (17, 37), (17, 38), (17, 39),               -- Le Parrain
    (18, 40), (18, 41), (18, 42),               -- Fight Club
    (19, 43), (19, 44), (19, 45),               -- Les Affranchis
    (20, 46), (20, 47), (20, 48);               -- Parasite
