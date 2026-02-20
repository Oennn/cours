public class CelluleDouble<T> {
    T valeur;
    CelluleDouble<T> suivant;
    CelluleDouble<T> precedent;

    public CelluleDouble(T valeur) {
        this.valeur = valeur;
        this.suivant = null;
        this.precedent = null;
    }
}
