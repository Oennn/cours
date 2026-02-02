public class Cercle {
    private Point centre;
    private double rayon;

    //association car on est dans le même package, et que la classe cercle n'est pas un point.

    public Cercle(Point centre, double rayon){
        this.centre=centre;
        this.rayon=rayon;
    }
    // Accesseurs
    public Point getCentre() {
        return centre;
    }

    public double getRayon() {
        return rayon;
    }

    public void setCentre(Point centre) {
        this.centre = centre;
    }

    public void setRayon(double rayon) {
        this.rayon = rayon;
    }
    public String toString(){
        return "centre=("+centre.getX()+","+centre.getY()+"), rayon="+rayon;
    }

    public void translation(double dx, double dy){
        centre.translation(dx, dy);
    }
    public void homothetie(Point centre, double k){
        homothetie(centre.getX(), centre.getY(), k);
    }
    public void homothetie(double centreX, double centreY, double k){
        centre.homothetie(centreX,centreY, k); //pas faire de = , le void de Point le fait déjà.
        rayon*=k;
    }


}
