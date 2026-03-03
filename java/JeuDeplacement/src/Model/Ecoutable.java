package Model;

import View.Ecouteur;
import java.util.ArrayList;
import java.util.List;

/**
 * Classe abstraite pour le pattern Observer
 * Permet aux modèles de notifier les vues des changements
 */
public abstract class Ecoutable {
    private List<Ecouteur> abonnes = new ArrayList<>();

    /**
     * Ajouter un écouteur (généralement une vue)
     */
    public void ajoutEcouteur(Ecouteur e) {
        abonnes.add(e);
    }

    /**
     * Notifier tous les écouteurs d'un changement
     */
    protected void fireChange() {
        for (Ecouteur e : abonnes) {
            e.modeleMisAJour(this);
        }
    }
}

