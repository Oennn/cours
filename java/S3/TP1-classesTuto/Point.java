public class Point{
    private double x;
    private double y;

    private static int nInstances = 0;

    public Point(double x, double y){
        this.x=x;
        this.y=y;
        nInstances+=1;
    }
    public Point(){
        this(0,0);
    }

    //accesseurs
    public double getX(){
        return x;
    }

    public double getY(){
        return y;
    }
    //accesseur static
    public static int getNbInstances(){
        return nInstances;
    }

    // Mutateurs
    public void setX(double x){
        this.x=x;
    }
    

    public void setY(double y){
        this.y=y;
    }


    public String toString(){
        return "("+x+","+y+")";
    }

    public void translation(double dx, double dy){
        x+=dx;
        y+=dy;
    }
    public void homothetie(Point centre, double k){
        homothetie(centre.getX(), centre.getY(), k);
    }
    public void homothetie(double centreX, double centreY, double k){
        x=k*(x-centreX)+centreX;
        y=k*(y-centreY)+centreY;
    }


}