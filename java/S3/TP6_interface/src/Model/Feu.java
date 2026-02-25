package Model;

import java.util.ArrayList;
import java.util.List;



public class Feu extends Ecoutable {
    public enum Couleur { VERT, ORANGE, ROUGE }
    private Couleur etatActuel = Couleur.VERT;

    public void suivant() {
        if (etatActuel == Couleur.VERT) etatActuel = Couleur.ORANGE;
        else if (etatActuel == Couleur.ORANGE) etatActuel = Couleur.ROUGE;
        else etatActuel = Couleur.VERT;

        fireChange(); // <--- TRÈS IMPORTANT : Prévient les vues
    }

    public Couleur getEtat() { return etatActuel; }
}