public class Devise {
    private String nom;
    private String symbole;
    private double taux;

    public Devise(String nom, String symbole, double taux) {
        this.nom = nom;
        this.symbole = symbole;
        this.taux = taux;
    }

    public static double convertir(double montant, Devise deviseSource, Devise deviseCible) {
        double enEuro = montant / deviseSource.taux;
        return enEuro * deviseCible.taux;
    }

    public String getNom() {
        return nom;
    }

    public String getSymbole() {
        return symbole;
    }

    public double getTaux() {
        return taux;
    }

    @Override
    public String toString() {
        return nom + " (" + symbole + ")";
    }
}

