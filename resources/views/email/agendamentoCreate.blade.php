<h3>Agendamento criado com sucesso!</h3><br>
Dia: {{date('d/m/Y', strtotime($agendamento->data))}} às {{$agendamento->hora}}<br>
Barbeiro: {{$agendamento->barbeiro->nome}}<br>
Barbearia: {{$agendamento->barbearia->nome}}