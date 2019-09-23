import React, { Fragment, Component } from 'react';
import ReactDOM from 'react-dom';

export default class InterestDynamicInput extends Component {
    
    constructor(props) {
        super(props)
        this.state = {
            interestInputs: []
        }
    }

    addInterestInput() { this.setState({interestInputs: [...this.state.interestInputs, ""] }) }

    render() {
        return (
            <Fragment>
                {
                    this.state.interestInputs.map((interestInput, index) => {
                        return (
                            <div key={index}>
                                <div className="input-field">
                                    <input id={"interest_input_"+index} name="interest_inputs[]" type="text" />
                                    <label htmlFor={"interest_input_"+index}>Caso não tenha encontrado a área do seu interesse, digite nesta linha (uma área por linha):</label>
                                </div>
                            </div>
                        )
                    })
                }
                <a onClick={()=>this.addInterestInput()} className="waves-effect waves-light btn yellow darken-3"><i className="material-icons left">add</i>Adicionar área de interesse</a>
            </Fragment>
        );
    }
}

if (document.getElementById('interest_dynamic_input_id')) {
    ReactDOM.render(<InterestDynamicInput />, document.getElementById('interest_dynamic_input_id'));
}
