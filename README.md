
# TP03 — Design Graphique
582-31B-MA – Programmation web avancée

---

Voici le site d’une entreprise de design graphique.

### Fonctionnalités
Le site permettra d'afficher les projets de l'entreprise ainsi que leurs services qu'ils offrent, et ce, visible pour tous.
La page 'Mon compte' permettra aux clients de voir l'historique de leurs projets et leurs factures.
Dépendant des droits établis, le site permettra aussi de créer des nouveaux projets et les modifier, créer des factures et les modifier, ajouter des clients et les modifier, ajouter des comptes d'utilisateurs, les modifier et les supprimer, au besoin.

La navigation, affichera les pages accessibles en fonction du privilège des utilisateurs connectés.


### Utilisateurs et privilèges
##### Visiteurs
Ils pourront voir les projets et les services offerts par l'entreprise.

##### Clients
Ils pourront consulter l'historique de leurs projets et factures. Ils pourront aussi , s'ils le désirent, modifier les informations de leur compte d'utilisateur ou le supprimer.

##### Employés
Ils pourront, une fois connecté, ajouter des factures ou en visonner leurs détails, créer des nouveaux projets et les modifier, afficher la liste des clients, en ajouter et les modifier, ainsi que créer des comptes d'utilisateur pour client (seulement), les modifier ou les supprimer, si nécessaire.

##### Administrateurs (Admin)
Ils pourront tout faire! Donc, en plus des fonctionnalités déjà mentionnées, ils auront les droits pour ajouter des utilisateurs 'Employé', les modifier ainsi que de les supprimer, au besoin. Ils seront aussi les seuls à avoir le privilège de modifier les factures.

---

Structure :
MVC et TWIG

Lien du site :
e2196008.webdev.cmaisonneuve.qc.ca/prog_web_avancee/designGraphique
