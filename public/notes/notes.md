# Aide à la compréhension du projet

## Lister les catégories

- Dans la **classe abstraite Manager** (Manager.php) se trouve la *méthode findAll()* qui permet de lister les enregistrements d'une table
    - la requête pour ordonner (ORDER BY)
    - la requête pour sélectionner les résultats (SELECT)
    - la méthode *getMultipleResults()*  est utilisée car la requête renvoie plusieurs enregistrements 
- Dans le **Controller ForumController** se trouve la *méthode index()*
    - une nouvelle instance de *CategoryManager* est instanciée
    - on utilise la *méthode findAll()* pour récupérer la liste de toutes les catégories et on les trie de manière décroissante par nom
- Dans la vue **listCategories** on boucle sur le résultat de la requête pour afficher chaque enregistrement