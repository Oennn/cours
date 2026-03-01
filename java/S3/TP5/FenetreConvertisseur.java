import javax.swing.*;

public class FenetreConvertisseur extends JFrame {

    public FenetreConvertisseur() {
        setTitle("Convertisseur de Devises");
        setSize(400, 150);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setLocationRelativeTo(null);

        add(new ConvertisseurPanel());

        setVisible(true);
    }

    public static void main(String[] args) {
        SwingUtilities.invokeLater(() -> new FenetreConvertisseur());
    }
}

