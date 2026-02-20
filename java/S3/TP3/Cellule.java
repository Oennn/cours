public class Cellule<T> {
    T valeur;
    Cellule<T> suivant;

    public Cellule(T valeur) {
        this.valeur = valeur;
        this.suivant = null;
    }
}
