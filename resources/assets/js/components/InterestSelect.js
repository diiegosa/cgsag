import React, { Fragment, Component } from 'react';
import ReactDOM from 'react-dom';
import Select from 'react-select';

export default class InterestSelect extends Component {
    
    constructor(props) {
        super(props)
        this.state = {}
    }
    
    render() {
        return (
            <Fragment>
                <Select
                    options={this.props.interests}
                    placeholder="Selecione as áreas de interesse"
                    isMulti={true}
                    id="interests_select"
                    name="interests_select[]"
                    defaultValue={this.props.interestsSelected}
                />
            </Fragment>
        );
    }
}

if (document.getElementById('interest_select_id')) {
    const node = document.getElementById('interest_select_id');
    ReactDOM.render(
        <InterestSelect 
            interests={JSON.parse(node.getAttribute('interests'))} 
            interestsSelected={JSON.parse(node.getAttribute('interestsSelected'))} 
        />, 
        document.getElementById('interest_select_id')
    );
}
