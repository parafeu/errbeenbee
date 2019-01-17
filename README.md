# ErrBeeNBee

ErrBeeNBee est un projet inspiré par Airbnb fait avec symfony

## Diagramme de classe : 

![alt text](https://raw.githubusercontent.com/parafeu/errbeenbee/dev/errbeenbee.png)

## Choix techniques

Nous avons décidés de créer une classe abstraite User et Accomodation, qui sont toutes étendues.
User est étendue par Traveller et Owner (Pour l'instant aucune différences entre les deux mais nous avons décidés de les faire en prévision)
Accomodation est étendue par Room et House, représentant une chambre ou un logement complet. Le voyageur peux donc réserver soit une chambre soit un logement complet.

## Travail effectué

- Création de l'index avec une visibilités sur les chambres et les logements
- Création du formulaire d'inscription pour les voyageurs et les propriétaires
- Implémentation du Bundle Sonata Media, permettant la mise en ligne et le stockage d'images
- Création de l'API Rest
