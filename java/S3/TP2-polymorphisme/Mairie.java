public class Mairie {
    private String name;
    private String nameMaire;
    private int nbHab;
    private Batiment[] batiments;

    public Mairie( String name,String nameMaire,int nbHab,Batiment[] batiments){
        this.name=name;
        this.nameMaire=nameMaire;
        this.nbHab=nbHab;
        this.batiments=batiments;
    }

    public Double getImpotsTotal(){
        double sum=0;
        for(int i=0; i< batiments.length;i++){
            sum+=batiments[i].impots();
        }
        return sum;
    }

    public String getImpotsMax(){
        double max=batiments[0].impots(); String hab=batiments[0].getName();
        for(int i=1; i< batiments.length;i++){
            if(batiments[i]!=null && max<batiments[i].impots()){
                max=batiments[i].impots();
                hab=batiments[i].getName();
            }

        }
        return hab;
    }


}
