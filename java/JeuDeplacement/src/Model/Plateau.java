package Model;

import java.util.ArrayList;
import java.util.List;

/**
 * Le modèle du jeu - Gère l'état du plateau et la logique métier
 */
public class Plateau extends Ecoutable {
    private List<Element> elements;
    private Element selected;
    private int largeur;
    private int hauteur;

    public Plateau(int largeur, int hauteur) {
        this.largeur = largeur;
        this.hauteur = hauteur;
        this.elements = new ArrayList<>();
        this.selected = null;

        // Initialiser quelques éléments de démo
        initialiserElements();
    }

    private void initialiserElements() {
        // Créer 3 éléments déplaçables
        elements.add(new Element(100, 100, 30, 30, true));
        elements.add(new Element(200, 150, 30, 30, true));
        elements.add(new Element(300, 200, 30, 30, false)); // Non déplaçable

        // Sélectionner le premier par défaut
        selected = elements.get(0);
    }

    // ========== GETTERS ==========
    public List<Element> getElements() {
        return elements;
    }

    public Element getSelectedElement() {
        return selected;
    }

    public int getLargeur() {
        return largeur;
    }

    public int getHauteur() {
        return hauteur;
    }

    // ========== LOGIQUE MÉTIER ==========

    /**
     * Sélectionner un élément à une position donnée
     */
    public void selectionnerElement(int x, int y) {
        Element ancien = selected;

        // Chercher quel élément est à cette position
        selected = elements.stream()
            .filter(e -> e.contient(x, y))
            .findFirst()
            .orElse(null);

        // Si on a changé de sélection, notifier les vues
        if (ancien != selected) {
            fireChange();
        }
    }

    /**
     * Déplacer l'élément sélectionné
     */
    public void deplacerSelection(int dx, int dy) {
        if (selected != null && selected.estDeplacable()) {
            selected.deplacer(dx, dy);
            fireChange();
        }
    }

    /**
     * Réinitialiser les positions des éléments
     */
    public void reinitialiser() {
        elements.clear();
        initialiserElements();
        fireChange();
    }
}

