package logica;

public class Jugador {
	
	private String idJugador;
	private String gamertag;
	private String password;
	private String nombreJugador;
	private String apellidoJugador;
	private String emailJugador;
	private String paisJugador;
	private String avatarJugador;
	
	public Jugador(String id, String tag, String password, String nombre, String apellido, String email, String pais, String avatar) {
		this.idJugador = id;
		this.gamertag = tag;
		this.password = password;
		this.nombreJugador = nombre;
		this.apellidoJugador = apellido;
		this.emailJugador = email;
		this.paisJugador = pais;
		this.avatarJugador = avatar;
	}

	public Jugador() {
		// TODO Auto-generated constructor stub
	}

	public String getIdJugador() {
		return idJugador;
	}

	public void setIdJugador(String idJugador) {
		this.idJugador = idJugador;
	}

	public String getGamertag() {
		return gamertag;
	}

	public void setGamertag(String gamertag) {
		this.gamertag = gamertag;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}

	public String getNombreJugador() {
		return nombreJugador;
	}

	public void setNombreJugador(String nombreJugador) {
		this.nombreJugador = nombreJugador;
	}

	public String getApellidoJugador() {
		return apellidoJugador;
	}

	public void setApellidoJugador(String apellidoJugador) {
		this.apellidoJugador = apellidoJugador;
	}

	public String getEmailJugador() {
		return emailJugador;
	}

	public void setEmailJugador(String emailJugador) {
		this.emailJugador = emailJugador;
	}

	public String getPaisJugador() {
		return paisJugador;
	}

	public void setPaisJugador(String paisJugador) {
		this.paisJugador = paisJugador;
	}

	public String getAvatarJugador() {
		return avatarJugador;
	}

	public void setAvatarJugador(String avatarJugador) {
		this.avatarJugador = avatarJugador;
	}

	
}
