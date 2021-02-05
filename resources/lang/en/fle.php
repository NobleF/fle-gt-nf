<?php
return [
    'profile' => [
        'layout' => 'Profil',
        'title' => 'Mon profil'
    ],
    'board' => [
        'layout' => 'Carnet de bord',
        'title' => 'Carnet de bord',
        'date_debut' => 'Du :',
        'date_fin' => 'Au :',
        'btn_filter' => 'Filtrer',
        'add_activity' => 'Ajouter une activitée',
        'table' => [
            'num' => 'N°',
            'title' => 'Titre',
            'date' => [
                'start' => 'Début',
                'end' => 'Fin',
                'time' => 'Temps passé'
            ],
            'lang' => 'Langue',
            'commentary' => [
                'user' => 'Commentaire apprenant',
                'teacher' => 'Commentaire enseignant',
            ],
            'action' => 'Action',
            'show' => 'Voir',
            'edit' => 'Editer',
            'delete' => 'Supprimer',
        ],
        'modal' => [
            'nom' => 'Nom',
            'language' => 'Langue',
            'ressource' => 'Ressource',
            'commentaire' => 'Commentaire',
            'cancel' => 'Annuler',
            'add' => 'Ajouter',
        ],
    ],

    'file' => [
        'upload' => [
            'layout' => 'Téléverser des fichiers',
            'title' => 'Mise en ligne de document',
            'load_file' => 'Téléverser',
            'add_file' => 'Ajouter un fichier supplémentaire',
            'del_file' => 'Supprimer'
        ],
        'online' => [
            'layout' => 'Fichiers téléversés',
            'title' => 'Fichiers mis en ligne',
            'board' => [
                'num' => 'N°',
                'name' => 'Nom',
                'upload_date' => 'Date de mise en ligne',
                'action' => 'Action',
                'download' => 'Télécharger',
                'delete' => 'Supprimer',
            ],
        ],
    ],
    'manage' => [
        'layout' => 'Manager',
        'user' => [
            'layout' => 'Gestion des utilisateurs',
            'title' => 'Listes des utilisateurs',
            'new_user' => 'Nouvel utilisateur',
            'num' => 'N°',
            'lastname' => 'Nom',
            'name' => 'Prénom',
            'email' => 'Email',
            'roles' => 'Rôles',
            'action' => 'Action',
            'show' => [
                'title' => 'Voir',
                'email' => 'Email : ',
                'back' => 'Retour',
                'edit' => 'Editer l\'utilisateur',
            ],
            'edit' => [
                'title' => 'Editer',
            ],
            'delete' => 'Supprimer',
        ],
        'role' => 'Gestion des rôles',

    ],
];
