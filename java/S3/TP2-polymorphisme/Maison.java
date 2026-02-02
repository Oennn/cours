public class Maison extends Batiment{
    private int pieces;
    private Boolean piscine;

    public Maison(String proprietaire, String adresse, double surface, int pieces, boolean piscine) {
        super(proprietaire, adresse, surface);
        this.pieces = pieces;
        this.piscine = piscine;
    }

    // Constructeur spécifique (4 pièces, pas de piscine)
    public Maison(String proprietaire, String adresse, double surface) {
        super(proprietaire, adresse, surface);
        this.pieces = 4;
        this.piscine = false;
    }
    public int getPieces(){
        return pieces;
    }
    public Boolean getPiscine(){
        return piscine;
    }

    public double impots(){
        return 50*getPieces() + (getPiscine() ? 40 : 0);
    }
}
