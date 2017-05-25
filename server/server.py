import os
import numpy as np
import pandas as pd
from flask import Flask, abort, jsonify, request
import pickle
from flask_cors import cross_origin
from sklearn.metrics import classification_report, confusion_matrix
cur_dir = os.path.dirname(__file__)
loaded_model = pickle.load(open(os.path.join(cur_dir,'rf_loan_classification.pkl'), 'rb'))

app = Flask(__name__)
@app.route('/training', methods=['POST'])
@cross_origin()
def upload_data():
    df = pd.read_csv('loan_data.csv')
    categorical_feats = ['purpose']
    final_df = pd.get_dummies(df, columns=categorical_feats, drop_first=True)
    # Train the random forest classification model
    from sklearn.model_selection import train_test_split
    from sklearn.metrics import classification_report, confusion_matrix
    from sklearn.ensemble import RandomForestClassifier
    X = final_df.drop('not.fully.paid', axis=1)
    y = final_df['not.fully.paid']
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.30, random_state=101)
    rfc = RandomForestClassifier(n_estimators=100)
    rfc.fit(X_train, y_train)
    # Classification Report
    from sklearn.metrics import classification_report,confusion_matrix
    class_report = classification_report(y_test, loaded_model.predict(X_test))
    conf_matrix = confusion_matrix(y_test, loaded_model.predict(X_test))
    print (class_report)
    print (conf_matrix)
    return class_report

#save the random forest classification model
@app.route('/save_model', methods=['POST'])
@cross_origin()
def save_model():

    df = pd.read_csv('loan_data.csv')
    categorical_feats = ['purpose']
    final_df = pd.get_dummies(df, columns=categorical_feats, drop_first=True)
    # Train the random forest classification model
    from sklearn.model_selection import train_test_split
    from sklearn.metrics import classification_report, confusion_matrix
    from sklearn.ensemble import RandomForestClassifier
    X = final_df.drop('not.fully.paid', axis=1)
    y = final_df['not.fully.paid']
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.30, random_state=101)
    rfc = RandomForestClassifier(n_estimators=100)
    rfc.fit(X_train, y_train)
    rffilename = 'rf_loan_classification.pkl'
    pickle.dump(rfc, open(rffilename, 'wb'))
    return rffilename

# load the model
# def loaded_model():
#     # load the model
#     rffilename = save_model()
#     loaded_model = pickle.load(open(rffilename, 'rb'))
#     return loaded_model
# Make Prediction

@app.route('/prediction', methods=['POST'])
@cross_origin()
def make_predict():
    data = request.get_json(force=True)
    predict_request = [data['credit_policy'],data['int_rate'],data['installment'],data['log_annual_inc'],data['dti'],data['fico'],data['days_with_cr_line'],data['revol_bal'],data['revol_util'],data['inq_last_6mths'],data['delinq_2yrs'],data['pub_rec'],data['purpose_credit_card'],data['purpose_debt_consolidation'],data['purpose_educational'],data['purpose_home_improvement'],data['purpose_major_purchase'],data['purpose_small_business']]
    predict_request = np.array(predict_request).reshape(1,-1)
    Predict_output = loaded_model.predict(predict_request)
    # output = {'Predict_output': int(Predict_output[0])}
    output = int(Predict_output[0])
    # Return probability
    prob = loaded_model.predict_proba(predict_request)
    Prob_output = prob[0][1]
    print(output)
    print(prob)
    return jsonify(results=output, probability = Prob_output)

if __name__ == '__main__':
    app.run(port=7000, debug=True)

app = Flask(__name__)
