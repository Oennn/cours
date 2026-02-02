public class Usine extends Batiment{
    private String entreprise;

    public Usine(String name, String adresse, double surface,String entreprise){
        super(name,adresse,surface);
        this.entreprise=entreprise;
    }

    public String getNomEntreprise(){
        return entreprise;
    }
    public String toString() {
        return super.toString() + ", entreprise= " + entreprise; // pour le swag sinon on fait via getName(),...
    }

    
}
