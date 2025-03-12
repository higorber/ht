# Sistema de Gestão de Hospedagem e Reservas

Este sistema foi desenvolvido para gerenciar hospedagens e reservas para um estabelecimento. O **Anfitrião** pode cadastrar e gerenciar as hospedagens, enquanto o **Hóspede** pode realizar reservas, que depois são confirmadas pelo Anfitrião. A comunicação entre o Anfitrião e o Hóspede segue para o **WhatsApp** para facilitar a confirmação de pagamento e mais detalhes da estadia.

## Instruções de Instalação e Configuração

### 1. Instalar o XAMPP

Para rodar o sistema localmente, você precisará instalar o **XAMPP**, que inclui o servidor Apache (para rodar o sistema web) e o MySQL (para gerenciar o banco de dados).

- Baixe o XAMPP em: [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html)
- Após o download, execute o instalador e siga os passos de instalação.
- Depois de instalado, abra o **Painel de Controle do XAMPP** e inicie os módulos **Apache** e **MySQL**.

### 2. Criar Banco de Dados no phpMyAdmin

Após a instalação do XAMPP, siga os passos abaixo para configurar o banco de dados:

1. Abra o navegador e acesse `http://localhost/phpmyadmin/`.
2. Crie um banco de dados chamado `hotel_bd`.
3. Importe o arquivo `hotel_bd.sql` (este arquivo deve estar disponível para você) para o banco de dados criado, clicando em "Importar" e selecionando o arquivo `.sql` no seu computador.

### 3. Configuração do Sistema

Após configurar o XAMPP e o banco de dados, siga os passos abaixo para acessar o sistema e fazer as configurações necessárias:

1. **Acesso ao Sistema:**
   - Abra o navegador e acesse o sistema através de `http://localhost/ht/`.
   
2. **Cadastro de Usuários:**
   - O sistema possui um sistema de cadastro para **Anfitriões** e **Hóspedes**. 
   - O **Anfitrião** pode cadastrar, gerenciar e visualizar as hospedagens e as reservas.
   - O **Hóspede** pode fazer reservas nas hospedagens cadastradas pelo Anfitrião.

3. **Gerenciamento de Hospedagens:**
   - O **Anfitrião** pode cadastrar novas **hospedagens** e gerenciar informações relacionadas, como preços, disponibilidade e outras configurações.
   
4. **Reserva pelo Hóspede:**
   - O **Hóspede** pode visualizar as hospedagens disponíveis e realizar uma **reserva**.
   - Após a reserva ser realizada, o **Anfitrião** será notificado para confirmar ou recusar a reserva.

5. **Confirmação de Reserva:**
   - Após o **Anfitrião** confirmar a reserva, o Hóspede será redirecionado para o **WhatsApp** para concluir o pagamento e outros detalhes relacionados à estadia.

6. **Consideração sobre Dieta para Celíacos:**
   - No cadastro de cada hospedagem, o **Anfitrião** pode informar se o local oferece opções para **celíacos** (sem glúten). Isso permite que Hóspedes com restrições alimentares possam fazer uma escolha mais informada sobre onde se hospedar.

### 4. Acesso ao Documento Completo

Para mais detalhes sobre a implementação do sistema, consulte o [documento completo aqui](https://docs.google.com/document/d/1PHGvojWyHI4i-P7Dpq1Ju9eAYZaLj7VE/edit?usp=sharing&ouid=109116318482722390567&rtpof=true&sd=true).

---

## Licença

Distribuído sob a licença MIT. Veja `LICENSE` para mais informações.

---

## Contato

Se tiver dúvidas ou sugestões, entre em contato com [seu_email@dominio.com](mailto:seu_email@dominio.com).
