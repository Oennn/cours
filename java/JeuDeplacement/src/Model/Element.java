package Model;

/**
 * Un élément du plateau - peut être un personnage, un obstacle, etc.
 */
public class Element {
    private int x, y;
    private int largeur, hauteur;
    private boolean deplacable;

    public Element(int x, int y, int largeur, int hauteur, boolean deplacable) {
        this.x = x;
        this.y = y;
        this.largeur = largeur;
        this.hauteur = hauteur;
        this.deplacable = deplacable;
    }

    // ========== GETTERS ==========
    public int getX() { return x; }
    public int getY() { return y; }
    public int getLargeur() { return largeur; }
    public int getHauteur() { return hauteur; }
    public boolean estDeplacable() { return deplacable; }

    // ========== LOGIQUE MÉTIER ==========

    /**
     * Vérifier si cet élément contient un point (x, y)
     */
    public boolean contient(int px, int py) {
        return px >= x && px < x + largeur &&
               py >= y && py < y + hauteur;
    }

    /**
     * Déplacer l'élément de (dx, dy)
     */
    public void deplacer(int dx, int dy) {
        if (deplacable) {
            x += dx;
            y += dy;
        }
    }
}

