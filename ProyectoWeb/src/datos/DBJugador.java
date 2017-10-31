package datos;

import java.sql.PreparedStatement;
import java.sql.SQLException;

import logica.Jugador;

public class DBJugador {

	private DBConection con;

	public DBJugador() {
		con = new DBConection();
	}
	
	public boolean insertarJugador(Jugador jugador){
				
		try {
			StringBuilder strBSlq = new StringBuilder();
            strBSlq.append(" INSERT INTO JUGADORES");
            strBSlq.append(" (GAMERTAG, PASSWORD, NOMBRE, APELLIDO, PAIS)");
            strBSlq.append(" VALUES ");
            strBSlq.append(" (?,?,?,?,?) ");
            if(!con.getConexion().isClosed()){
            	PreparedStatement ps = con.getConexion().prepareStatement(strBSlq.toString());
            	ps.setString(1, jugador.getGamertag());
            	ps.setString(2, jugador.getGamertag());
            	ps.setString(3, jugador.getNombreJugador());
            	ps.setString(4, jugador.getApellidoJugador());
            	ps.setString(5, jugador.getPaisJugador());
            	
            	boolean bandera = ps.executeUpdate() > 0;
            	return bandera;
            }
            else {
            	System.out.println("Conexion cerrada");
            	return false;
            }
		}catch (SQLException e) {
			// TODO: handle exception
			
			System.out.println(e);
			return false;
		}
	}
}
