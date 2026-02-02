public class Ennemies implements Personnage{
    private String nom;
    private int pv;
    private int attaque;
    private ClasseEnnemie classe;

    public Ennemies(ClasseEnnemie classe){
        this.nom=classe.name();
        this.classe=classe;
        this.pv=pvAlea(classe.getPvBase());
        this.attaque=classe.getAttaqueBase();
    }



    @Override
    public void subirDegats(int degats) {
        pv -= degats;
        if (pv < 0) {
            pv = 0;
        }
    }

    @Override
    public boolean estVivant() {
        return pv > 0;
    }
    // Méthodes utiles mais non imposées par l’interface
    public String getNom() {
        return nom;
    }

    public int getPv() {
        return pv;
    }
    public int getAttaque(){
        return attaque;
    }

    public ClasseEnnemie getClasse() {
        return classe;
    }
    public int pvAlea(int pvBase){
        int min = (int)(pvBase*0.8);
        int max= (int)(pvBase*1.2);
        return min + (int)(Math.random()*(max-min+1)); //entre min et max
    }
    /* 
    public int attaqueAlea(int attaque){
        if(nom.equals("ZOMBIE")){
            int min = (int)(attaque*0.8);
            int max= (int)(attaque*1.2);
            return min + (int)(Math.random()*(max-min+1)); //entre min et max
        }
        return attaque;
    }*/

}
