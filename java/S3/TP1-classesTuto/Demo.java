import java.util.List;

public class Demo {
    public static void main(String[] args){
        Point p1=new Point(5,2);
        Point p2=new Point(2,2);
        Point p3=new Point(1,1);

        System.out.println("p1: "+p1.toString());
        System.out.println("p2: "+p2.toString());
        System.out.println("p3: "+p3.toString());
        System.out.println("nbInstances: "+Point.getNbInstances()); // comme static, pas besoin de prendre un pi
        //============================================================

        //translation et homothétie :
        p1.translation(1, 1);
        System.out.println("p1 translation: "+p1.toString());
        p2.homothetie(p3, 3);
        System.out.println("p2 homothétie: "+p2.toString());
        //============================================================

        Point p4=new Point(2,2);
        Cercle c1=new Cercle(p4,4);
        c1.homothetie(p3, 3);

        System.out.println("c1 homothétie: "+c1.toString());
        //============================================================

        List<Point> sommets = List.of(new Point(0,0),new Point(4,0),new Point(4,3));

        Polygone triangle = new Polygone(sommets);
        System.out.println("aire du Polygone: "+triangle.airePolygone()); // 6.0
    
    
    
    }
}
