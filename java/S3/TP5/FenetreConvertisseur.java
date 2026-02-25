import javax.swing.*;

public class FenetreConvertisseur extends JFrame {

    public FenetreConvertisseur() {

        setTitle("Convertisseur de devises");
        setSize(1200, 400);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

        // On ajoute le JPanel
        add(new ConvertisseurPanel());

        setLocationRelativeTo(null); // centre la fenêtre
        setVisible(true);
    }

    public static void main(String[] args) {
        new FenetreConvertisseur();
    }
}