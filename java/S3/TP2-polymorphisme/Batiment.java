public class Batiment{
    private String name;
    private String adresse;
    private double surface;

    public Batiment( String name,String adresse,double surface){
        this.name=name;
        this.adresse=adresse;
        this.surface=surface;
    }
     public String getName() {
        return name;
    }

    public String getAdresse() {
        return adresse;
    }

    public double getSurface() {
        return surface;
    }
    public double impots(){

        return 5*this.getSurface();
    }
    public String toString(){
        return "Batiment{" +"nom= " + name + ", adresse= " + adresse + ", surface= " + surface +'}';
    }

}