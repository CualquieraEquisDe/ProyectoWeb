package datos;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;

public class DBConection {

	static String database = "prueba";
    static String login = "root";
    static String password = "1234";
    static String url = "jdbc:mysql://localhost/"+database;
    static String mensaje = "";
    
    private Connection conexion = null;
    
    public DBConection() {
    	try{
            Class.forName("org.postgresql.Driver");
            conexion = DriverManager.getConnection(url,login,password);

            if (conexion!=null){
                    System.out.println("Conexión a base de datos "+database+" OK");
            }            
            
	    }catch(SQLException e){
	            mensaje = e.getMessage();
	    }catch(ClassNotFoundException e){
	            mensaje = e.getMessage();
	    }
    }
    
    public static String getMensaje() {
        return mensaje;
    }

    public static void setMensaje(String mensaje) {
        DBConection.mensaje = mensaje;
    }
        
    public Connection getConexion(){
        return conexion;
    }
    
    public void cerrarCon() {
        try {            
            conexion.close();
        } catch (SQLException ex) {
            Logger.getLogger(getClass().getName()).log(Level.SEVERE, null, ex);
        }
    }

    public void desconectar(){
        conexion = null;
    }
    
}
