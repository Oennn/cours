# TP5 - Convertisseur de Devises (Version Débutant)

## Fichiers

- **Devise.java** : Classe pour gérer les devises et convertir
- **ConvertisseurPanel.java** : Interface graphique (JPanel)
- **FenetreConvertisseur.java** : Fenêtre principale (JFrame)

## Compilation

```bash
javac *.java
```

## Exécution

```bash
java FenetreConvertisseur
```

## Fonctionnalités

### Étape 1 ✅ : Composant Principal
- 2 zones de texte pour entrer les montants
- 1 bouton "C" pour réinitialiser
- 2 boutons "→" et "←" pour convertir

### Étape 2 ✅ : Événements des Boutons
- Bouton "C" réinitialise les deux champs à 0.00
- Bouton "→" convertit devise 1 → devise 2
- Bouton "←" convertit devise 2 → devise 1

### Étape 3 ✅ : Événements des Zones de Texte
- Conversion en temps réel quand vous tapez
- Flag `isUpdatingFromModel` pour éviter la récursion infinie

## Utilisation

1. Entrez une valeur dans "Devise 1 (€)"
2. La valeur en "Devise 2 ($)" se met à jour automatiquement
3. Vous pouvez aussi cliquer sur "→" pour forcer la conversion
4. Cliquez sur "C" pour tout réinitialiser

## Taux de Change

Par défaut :
- 1 EUR = 1.08 USD

Modifiez dans `ConvertisseurPanel.java` ligne 23-24 si besoin.

