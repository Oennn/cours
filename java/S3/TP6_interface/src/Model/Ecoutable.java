package Model;

import View.Ecouteur;

import java.util.ArrayList;
import java.util.List;

abstract class Ecoutable {
    private List<Ecouteur> abonnes = new ArrayList<>();

    public void ajoutEcouteur(Ecouteur e) {
        abonnes.add(e);
    }

    protected void fireChange() {
        for (Ecouteur e : abonnes) {
            e.modeleMisAJour(this);
        }
    }
}
