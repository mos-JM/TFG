

class Question extends React.Component {

    constructor() {
      super();
      this.state = { answers: []};
      this.onInput = this.onInput.bind(this);
      this.buildRadioButtons = this.buildRadioButtons.bind(this);
      this.updateMessage = this.updateMessage.bind(this)
      this.barthelIndex = this.barthelIndex.bind(this)
      this.answers = []
      this.result = 0
    }

    updateMessage(e) {
        this.result = 0
        var values = Object.values((this.answers))
        if (values.length == 10) {
            values.forEach(this.barthelIndex);
        }
        else {
            this.setState({
                
            });
        }
            
        console.log("tamaño", values.length)
    }
    
    barthelIndex(value){
        this.result += parseInt(value.answer) * 5
        console.log("aqui ", this.result)
        var msgString

        if (this.result < 20)
            msgString = "Dependencia total"
        else if (this.result >= 21 && this.result <= 60)
            msgString = "Dependencia Grave"
        else if (this.result >= 61 && this.result <= 90)
            msgString = "Dependencia Moderada"
        else if (this.result >= 91 && this.result <= 99)
            msgString = "Dependencia Leve"    
        else
            msgString = "Independencia"
        this.setState({
            message2: msgString
        });
        
    }
  
    onInput(e) {
      const id = e.target.name;
      
      const answer = { id, answer: e.target.value };
     

      this.answers[id] = answer
      console.log("Array de respuestas", this.answers)
      /*if (this.state.answers.some(answer => answer.id === id)) {
        this.answers = [...this.state.answers.filter(answer => answer.id !== id), answer];
      } else {
        this.answers = [...this.state.answers, answer];
      }
      let an = (this.answers)
      this.setState({ an }, () => this.state.answers);*/
      


    }
  
    buildRadioButtons(arr, type, id) {
      return arr.map((choice, i) => {
        return (
          <div key={i}>
            <input
            type={type}
            name={id}
            value={i}
            onChange={this.onInput}
           
         />        
          <label id="cosa">{choice}</label>
        </div>
       )
    })
   }
  
    render() {
         
        var iterator = this.props.questionChoices.map((question, i) => {
            
        const { choices, questionType, questionID, questionText } = question;
        return (

            
                <div key={i}>
                <h3>{questionText}</h3>
                {this.buildRadioButtons(choices, questionType, questionID)}
                </div>
           
        );
        });
        return (
        <div>
            <div className="row">
                <div className="form">
                    <div >
                        <div className="h9">
                        {iterator}
                        </div>
                    </div>
                </div>

                
                
            </div>
            <div>
                <button className="btn btn-primary btn-block" onClick={this.updateMessage}>Calcular Resultado </button>
                <h6> {this.state.message2}</h6>
            </div>
        </div>
        
        
        );
        
    }
  }
  
  const questionChoices = [
    { "questionID": 0, "questionType": "radio", "questionText": "Comer", "choices": ["1. Dependiente", "2. Necesita ayuda para cortar, extender mantequilla, usar condimentos, etc.", "3. Independiente (capaz de usar cualquier instrumento)"]},
    { "questionID": 1, "questionType": "radio", "questionText": "Trasladarse entre la silla y la cama", "choices": ["1. Dependiente, no se mantiene sentado", "2. Necesita ayuda importante (1 persona entrenada o 2 personas), puede estar sentado", "3. Necesita algo de ayuda (una pequeña ayuda física o ayuda verbal)", "4. Independiente"]},
    { "questionID": 2, "questionType": "radio", "questionText": "Aseo personal", "choices": ["1. Dependiente", "2. Independiente para lavarse la cara, las manos y los dientes, peinarse y afeitarse"]},
    { "questionID": 3, "questionType": "radio", "questionText": "Uso del retrete", "choices": ["1. Dependiente", "2. Necesita alguna ayuda, pero puede hacer algo solo", "3. Independiente (entrar y salir, limpiarse y vestirse)"]},
    { "questionID": 4, "questionType": "radio", "questionText": "Bañarse o Ducharse", "choices": ["1. Dependiente", "2. Independiente para bañarse o ducharse"]},
    { "questionID": 5, "questionType": "radio", "questionText": "Desplazarse", "choices": ["1. Inmóvil", "2. Independiente en silla de ruedas en 50 m", "3. Anda con pequeña ayuda de una persona (física o verbal)", "4. Independiente al menos 50 m, con cualquier tipo de muleta, excepto andador"]},
    { "questionID": 6, "questionType": "radio", "questionText": "Subir y bajar escaleras", "choices": ["1. Dependiente", "2. Necesita ayuda física o verbal, puede llevar cualquier tipo de muleta", "3. Independiente para subir y bajar"]},
    { "questionID": 7, "questionType": "radio", "questionText": "Vestirse y desvestirse", "choices": ["1. Dependiente", "2. Necesita ayuda, pero puede hacer la mitad aproximadamente, sin ayuda", "3. Independiente, incluyendo botones, cremalleras, cordones, etc."]},
    { "questionID": 8, "questionType": "radio", "questionText": "Deposiciones", "choices": ["1. Incontinente (o necesita que le suministren enema)", "2. Accidente excepcional (uno/semana)", "3. Continente"]},
    { "questionID": 9, "questionType": "radio", "questionText": "Micción", "choices": ["1. Incontinente, o sondado incapaz de cambiarse la bolsa", "2. Accidente excepcional (máximo uno/24 horas)", "3. Continente, durante al menos 7 días"]}
  ]


  
  ReactDOM.render(
    <Question questionChoices={questionChoices} />,
    document.getElementById('root')
  );


