import java.util.*;

public class Polygone {
    private List<Point> sommets;

    public Polygone(List<Point> sommets){
        this.sommets=new ArrayList<>(sommets);
    }

    public List<Point> getSommets() {
        return new ArrayList<>(sommets);
    }
    public void translation(double dx, double dy){
        for(Point p : sommets){
            p.translation(dx, dy);
        }
        
    }
    public void homothetie(Point centre, double k){

        homothetie(centre.getX(), centre.getY(), k);
        
    }
    public void homothetie(double centreX, double centreY, double k){
        for(Point p : sommets){
            p.homothetie(centreX,centreY, k);
        }

    }
    public double airePolygone(){
        double sum=0;
        for(int i=0;i<sommets.size();i++){
            Point p1 = sommets.get(i); //pour récup chaque point
            Point p2 = sommets.get((i + 1) % sommets.size()); // 2e point, faire gaffe a pas depasser la liste

            sum+= p1.getX() * p2.getY() - p2.getX() * p1.getY(); //formule de l'aire d'un polygone quelconque (pas sûre) sachant que chaque iteration représente un trapeze
        }

        return  Math.abs(sum) / 2;
    }

    public String toString() {
        return "Polygone" + sommets;
    }



}
